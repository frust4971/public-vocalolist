# coding: UTF-8
import re
import os
from apiclient.discovery import build
import datetime
from dateutil.relativedelta import relativedelta
import env
import db
import const


env.load_env()
API_KEY = os.environ["YOUTUBE_API_KEY"]
youtube = build("youtube", "v3", developerKey=API_KEY)

class NotFoundVideoException(Exception):
    """
    YouTubeにアップロードされた動画がなんらかの理由で視聴できない場合に呼ぶクラス
    """
    def __init__(self):
        pass

    def __str__(self):
        return "動画が見つかりませんでした"

ng_word = re.compile('.*(字幕|ランキング|メドレー|替え歌|再生|検定|クイズ|テスト|なボカロ|演奏|ボカロP|top\d|踊ってみた|手描き|太鼓|叩いて|弾い|人力|mmd|mad|プロセカ|TV|ピアノ|combo|プロモ|コスプレ|しりとり|歌詞|プレイ|リアクション|sub|まとめ|再現|絵師|生放送|shorts|ゲームサイズ|アート展|(映像|一部)公開|デビュー|神回|リメイク|【中文】|version|CHUNITHM|イラスト|ビートセイバー).*', re.IGNORECASE)
japanese_pattern = re.compile('.*([ぁ-んァ-ヶ]).*')

vocalo_pattern = re.compile('^【MV】.*|.*オリジナル曲.*|.*MV$', re.IGNORECASE)
not_vocalo_pattern = re.compile('.*(歌[^愛]|cover|合唱|remix|曲|バンド|反応|diva|カバー|カラオケ|真似|ライブ|コラボ|チャレンジ|みた[^い]).*', re.IGNORECASE)
def is_vocalo_title(title):
    if ng_word.search(title):
        return False
    if vocalo_pattern.search(title):
        return True
    if not_vocalo_pattern.search(title):
        return False
    if japanese_pattern.search(title):
        return True
    return False

not_utattemita_pattern = re.compile('.*(feat|ボカロ曲|ft.|official|movie|歌い方|叩いてみた).*', re.IGNORECASE)
def is_utattemita_title(title):
    if ng_word.search(title):
        return False
    if not_utattemita_pattern.search(title):
        return False
    if japanese_pattern.search(title):
        return True
    return False

not_vocalo_description_pattern = re.compile('.*(放送日|broadcast|コスプレ|本家|VOCALOID ver|歌ってみた|オープニング|楽曲提供|イラストメイキング).*', re.IGNORECASE)
def is_vocalo_description(description):
    if not_vocalo_description_pattern.search(description):
        return False
    return True

not_utattemita_description_pattern = re.compile('.*(放送日|broadcast|人力VOCALOID|応募|購入).*', re.IGNORECASE)
def is_utattemita_description(description):
    if not_utattemita_description_pattern.search(description):
        return False
    return True

def crawl(word, video_duration, published_after, published_before, order_by="viewCount", page_token=None,max_results=50):
    """
    YouTubeから検索結果を取得するメソッド

    Parameters
    ----------
    word : string
        検索ワード

    video_duration : string
        動画の種類分け
        short 4分未満
        medium 4分以上20分以下

    published_after : datetime
        指定した日時より後に作成された動画を返す
    
    published_before : datetime
        指定した日時より前に作成された動画を返す
    
    order_by : string
        viewCount → 再生回数順
        relevance → 関連度順

    page_token : string
        検索結果の次のページを取得する際に設定する。例)page_token=search_response["nextPageToken"]
    """
    search_response = youtube.search().list(
        part="id,snippet",
        q=word,
        pageToken=page_token,
        order=order_by,
        type="video",
        maxResults=max_results,
        videoDuration=video_duration,
        publishedAfter=published_after,
        publishedBefore=published_before
    ).execute()
    return search_response

def get_video(video_id):
    response = youtube.videos().list(
        part="snippet,statistics",
        id=video_id,
    ).execute()
    if len(response["items"]) == 0:
        raise NotFoundVideoException()
    video = response["items"][0]
    return video

def check_video(title,description,is_utattemita_table=False):
    if is_utattemita_table:
        return is_utattemita_title(title) and is_utattemita_description(description)
    return is_vocalo_title(title) and is_vocalo_description(description)

def crawl_and_insert_into_db(table_name, word, video_duration, filter_view_count, published_after=None, published_before=None,num_search=50,order_by="viewCount",must_disconnect_db=False):
    """
    再生回数順の検索結果を指定したテーブルに挿入する。テーブルが整理対象であれば同時に整理も行う

    Parameters
    ----------
    table_name : string
        データを挿入するテーブル名

    word : string
        検索ワード

    video_duration : string
        動画の種類分け
        short 4分未満
        medium 4分以上20分以下

    filter_view_count : int
        指定した再生回数以上の動画を返す

    published_after : datetime
        指定した日時より後に作成された動画を返す
    
    published_before : datetime
        指定した日時より前に作成された動画を返す

    num_search : int
        動画の検索する数を指定する

    order_by : string
        viewCount → 再生回数順
        relevance → 関連度順
    
    must_disconnect_db : bool
        DBの切断を行うかどうか
    """
    is_utattemita_table = (table_name == const.RECENTLY_UTATTEMIATA_TABLE_NAME)
    counter = 0
    max_results = num_search - 50 * counter
    if max_results > 50:
        max_results = 50
    search_response = crawl(word, video_duration, published_after, published_before,order_by=order_by,max_results=max_results)
    videos = search_response["items"]
    finished = False
    while True:
        for video in videos:
            video_details = get_video(video["id"]["videoId"])
            view_count = int(video_details["statistics"]["viewCount"])
            if view_count < filter_view_count:
                if order_by == "relative":
                    continue
                finished = True
                break
            if db.is_inserted_item(table_name, video["id"]["videoId"]):
                continue
            
            if check_video(video["snippet"]["title"], video_details["snippet"]["description"],is_utattemita_table=is_utattemita_table):
                db.insert_video(table_name, video, view_count)

        if finished or max_results <= 50:
            break

        counter += 1 
        max_results = num_search - 50 * counter
        if max_results > 50:
            max_results = 50
        search_response = crawl(word, video_duration,published_after,published_before,order_by=order_by,page_token=search_response["nextPageToken"],max_results=max_results)
        videos = search_response["items"]
    
    db.delete_old_data(table_name)
    db.commit()
    if must_disconnect_db:
        db.disconnect()

def crawl_and_insert_famous_vocalovideos_into_db(table_name, word,  video_duration, filter_view_count, published_after=None, published_before=None):
    """
    歴代ボカロランキングを更新するためのメソッド。検索条件に引っかかった動画のみ挿入や更新を行う\r\n
    DB切断は使う側が行う必要がある\r\n
    クロールするページの上限がない。テーブルの整理は行わない\r\n
    実行する日程は決めて通常のクローリングと別の日に行ったほうがよい\r\n

    Parameters
    ----------
    table_name : string
        データを挿入するテーブル名

    word : string
        検索ワード

    video_duration : string
        動画の種類分け
        short 4分未満
        medium 4分以上20分以下

    filter_view_count : int
        指定した再生回数以上の動画を返す

    published_after : datetime
        指定した日時より後に作成された動画を返す
    
    published_before : datetime
        指定した日時より前に作成された動画を返す
    """
    search_response = crawl(word, video_duration,published_after,published_before)
    videos = search_response["items"]
    finished = False
    while True:
        for video in videos:
            video_details = get_video(video["id"]["videoId"])
            view_count = int(video_details["statistics"]["viewCount"])
            if view_count < filter_view_count:
                finished = True
                break
            if db.is_inserted_item(table_name, video["id"]["videoId"]):
                db.update_view_count(table_name,video["id"]["videoId"],view_count)
                continue
            
            if check_video(video["snippet"]["title"], video_details["snippet"]["description"]):
                db.insert_video(table_name, video, view_count)
            
        if finished:
            break
        search_response = crawl(word, video_duration,published_after,published_before,page_token=search_response["nextPageToken"])
        videos = search_response["items"]
    db.commit()
    
def update_all_view_count(table_name,must_disconnect_db=False):
    rows = db.get_all_video_id(table_name)
    for row in rows:
        video_id = row[0]
        try:
            video_details = get_video(video_id)
            view_count = int(video_details["statistics"]["viewCount"])
        except NotFoundVideoException:
            db.delete_video(table_name,video_id)
        db.update_view_count(table_name, video_id, view_count)
    db.commit()
    if must_disconnect_db:
        db.disconnect()