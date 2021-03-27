# coding: UTF-8
import re
import os
from apiclient.discovery import build
import datetime
from dateutil.relativedelta import relativedelta
import env
import db


env.load_env()
API_KEY = os.environ["YOUTUBE_API_KEY"]
youtube = build("youtube", "v3", developerKey=API_KEY)

def is_vocalo_title(title):
    
    if re.match('.*オリジナル曲.*',title):
        return True
    not_vocalo_pattern = re.compile('.*(歌|cover|演奏|メドレー|ランキング|再生|合唱|太鼓|remix|曲|弾い|みた|バンド|クイズ|反応|検定|テスト|人力|diva|カバー|cover|mmd|mad|カラオケ|真似|プロセカ|ライブ).*',re.IGNORECASE)
    if not_vocalo_pattern.match(title):
        return False
    if re.match('.*([亜-熙ぁ-んァ-ヶ]).*',title):
        return True
    return False

def is_utattemita_title(title):
    not_utattemita_pattern = re.compile('.*(ランキング|メドレー|替え歌|再生|feat|検定|クイズ|テスト|ボカロ曲|ft.|OP).*',re.IGNORECASE)
    if not_utattemita_pattern.match(title):
        return False
    if re.match('.*([亜-熙ぁ-んァ-ヶ]).*',title):
        return True
    return False

def crawl(word, video_duration, published_after, published_before, page_token=None, order_by="viewCount"):
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

    page_token : string
        検索結果の次のページを取得する際に設定する。例)page_token=search_response["nextPageToken"]
    """
    search_response = youtube.search().list(
        part="id,snippet",
        q=word,
        pageToken=page_token,
        order=order_by,
        type="video",
        maxResults=50,
        videoDuration=video_duration,
        publishedAfter=published_after,
        publishedBefore=published_before
    ).execute()
    return search_response

def get_view_count(video_id):
    response = youtube.videos().list(
        part="statistics",
        id=video_id,
    ).execute()
    video = response["items"][0]
    view_count = video["statistics"]["viewCount"]
    return int(view_count)

def crawl_and_insert_into_db(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None,must_disconnect_db=False):
    """
    再生回数順の検索結果を指定したテーブルに挿入する。100件まで。テーブルが整理対象であれば同時に整理も行う

    Parameters
    ----------
    table_name : string
        データを挿入するテーブル名

    word : string
        検索ワード

    is_utattemita : bool
        歌ってみたの判別に必要

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

    must_disconnect_db : bool
        DBの切断を行うかどうか
    """
    counter = 0
    search_response = crawl(word, video_duration,published_after,published_before)
    videos = search_response["items"]
    finished = False
    while True:
        counter += 1 
        for video in videos:
            view_count = get_view_count(video["id"]["videoId"])
            if view_count < filter_view_count:
                finished = True
                break
            if db.is_inserted_item(table_name, video["id"]["videoId"]):
                db.update_view_count(table_name,video["id"]["videoId"],view_count)
                continue

            if is_utattemita:
                if is_utattemita_title(video["snippet"]["title"]):
                    db.insert_video(table_name, video, view_count)
            elif is_vocalo_title(video["snippet"]["title"]):
                db.insert_video(table_name, video, view_count)
        finished = finished or counter <= 2
        if finished:
            break
        search_response = crawl(word, video_duration,published_after,published_before,page_token=search_response["nextPageToken"])
        videos = search_response["items"]
    
    db.delete_old_data(table_name)
    db.commit()
    if must_disconnect_db:
        db.disconnect()

def crawl_order_by_relevance_and_insert_into_db(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None,must_disconnect_db=False):
    """
    関連度順の検索結果を指定したテーブルに挿入する。50件まで。テーブルが整理対象であれば同時に整理も行う

    Parameters
    ----------
    table_name : string
        データを挿入するテーブル名

    word : string
        検索ワード

    is_utattemita : bool
        歌ってみたの判別に必要

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

    must_disconnect_db : bool
        DBの切断を行うかどうか
    """
    search_response = crawl(word, video_duration,published_after,published_before,order_by="relevance")
    videos = search_response["items"]
    for video in videos:
        view_count = get_view_count(video["id"]["videoId"])
        if view_count < filter_view_count:
            continue
        if db.is_inserted_item(table_name, video["id"]["videoId"]):
            db.update_view_count(table_name,video["id"]["videoId"],view_count)
            continue

        if is_utattemita:
            if is_utattemita_title(video["snippet"]["title"]):
                db.insert_video(table_name, video, view_count)
        elif is_vocalo_title(video["snippet"]["title"]):
            db.insert_video(table_name, video, view_count)
    db.delete_old_data(table_name)
    db.commit()
    if must_disconnect_db:
        db.disconnect()

def crawl_and_insert_famous_vocalovideos_into_db(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None):
    """
    歴代ボカロランキングを更新するためのメソッド。DB切断は使う側が行う必要がある\r\n
    クロールするページの上限がない。テーブルの整理は行わない\r\n
    実行する日程は決めて通常のクローリングと別の日に行ったほうがよい、使用するクォータは800程度\r\n

    Parameters
    ----------
    table_name : string
        データを挿入するテーブル名

    word : string
        検索ワード

    is_utattemita : bool
        歌ってみたの判別に必要

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
            view_count = get_view_count(video["id"]["videoId"])
            if view_count < filter_view_count:
                finished = True
                break
            if db.is_inserted_item(table_name, video["id"]["videoId"]):
                db.update_view_count(table_name,video["id"]["videoId"],view_count)
                continue

            if is_vocalo_title(video["snippet"]["title"]):
                db.insert_video(table_name, video, view_count)
        if finished:
            break
        search_response = crawl(word, video_duration,published_after,published_before,page_token=search_response["nextPageToken"])
        videos = search_response["items"]
    

    db.commit()
    
def update_all_view_count_in_famous_vocalovideos():
    rows = db.get_all_video_id_from_famous_vocalovideos()
    for row in rows:
        video_id = row[0]
        view_count = get_view_count(video_id)
        db.update_view_count("famous_vocalovideos", video_id, view_count)
    db.commit()
    db.disconnect()

def insert_into_db_by_id(table_name, video_id):
    response = youtube.videos().list(
    part="snippet,statistics",
    id=video_id,
    ).execute()
    video = response["items"][0]
    #searchのリソースと同じ形になるように調整
    video["id"] = {}
    video["id"]["videoId"] = video_id
    db.insert_video(table_name,video,int(video["statistics"]["viewCount"]))
    db.commit()