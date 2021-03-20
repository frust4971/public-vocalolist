# coding: UTF-8
import re
import os
from apiclient.discovery import build
import datetime
from dateutil.relativedelta import relativedelta
import EnvSetter
import DB


EnvSetter.setEnv()
API_KEY = os.environ["YOUTUBE_API_KEY"]
youtube = build("youtube", "v3", developerKey=API_KEY)

def isVocaloTitle(title):
    
    if re.match('.*オリジナル曲.*',title):
        return True
    notVocaloPattern = re.compile('.*(歌|cover|演奏|メドレー|ランキング|再生|合唱|太鼓|remix|曲|弾い|みた|バンド|クイズ|反応|検定|テスト|人力|diva|カバー|cover|mmd|mad|カラオケ|真似).*',re.IGNORECASE)
    if notVocaloPattern.match(title):
        return False
    if re.match('.*([亜-熙ぁ-んァ-ヶ]).*',title):
        return True
    return False

def isUtatteMitaTitle(title):
    notUtatteMitaPattern = re.compile('.*(ランキング|メドレー|替え歌|再生|feat|検定|クイズ|テスト|ボカロ曲).*',re.IGNORECASE)
    if notUtatteMitaPattern.match(title):
        return False
    if re.match('.*([亜-熙ぁ-んァ-ヶ]).*',title):
        return True
    return False


def crawl(word, video_duration, published_after, published_before, page_token=None):
    search_response = youtube.search().list(
        part="id,snippet",
        q=word,
        pageToken=page_token,
        order="viewCount",
        type="video",
        maxResults=50,
        videoDuration=video_duration,
        publishedAfter=published_after,
        publishedBefore=published_before
    ).execute()
    return search_response

def crawlOrderByRelevance(word, video_duration, published_after, published_before):
    search_response = youtube.search().list(
        part="id,snippet",
        q=word,
        type="video",
        maxResults=50,
        videoDuration=video_duration,
        publishedAfter=published_after,
        publishedBefore=published_before
    ).execute()
    return search_response

def getViewCount(video_id):
    response = youtube.videos().list(
        part="statistics",
        id=video_id,
    ).execute()
    video = response["items"][0]
    view_count = video["statistics"]["viewCount"]
    return int(view_count)

def crawlAndInsertToDB(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None,must_disconnect_db=False):
    """
    再生回数の検索結果を指定したテーブルに挿入する。テーブルが整理対象であれば同時に整理も行う

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
            view_count = getViewCount(video["id"]["videoId"])
            if view_count < filter_view_count:
                finished = True
                break
            if DB.isAlreadyInsertedItem(table_name, video):
                DB.updateViewCount(table_name,video["id"]["videoId"],view_count)
                continue

            if is_utattemita:
                if isUtatteMitaTitle(video["snippet"]["title"]):
                    DB.insertVideo(table_name, video, view_count)
            elif isVocaloTitle(video["snippet"]["title"]):
                DB.insertVideo(table_name, video, view_count)
        finished = finished or counter <= 2
        if finished:
            break
        search_response = crawl(word, video_duration,published_after,published_before,page_token=search_response["nextPageToken"])
        videos = search_response["items"]
    
    DB.deleteOldData(table_name)
    DB.commit()
    if must_disconnect_db:
        DB.disconnect()

def crawlOrderByRelevanceAndInsertToDB(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None,must_disconnect_db=False):
    """
    再生回数の検索結果を指定したテーブルに挿入する。テーブルが整理対象であれば同時に整理も行う

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
    search_response = crawlOrderByRelevance(word, video_duration,published_after,published_before)
    videos = search_response["items"]
    for video in videos:
        view_count = getViewCount(video["id"]["videoId"])
        if view_count < filter_view_count:
            continue
        if DB.isAlreadyInsertedItem(table_name, video):
            DB.updateViewCount(table_name,video["id"]["videoId"],view_count)
            continue

        if is_utattemita:
            if isUtatteMitaTitle(video["snippet"]["title"]):
                DB.insertVideo(table_name, video, view_count)
        elif isVocaloTitle(video["snippet"]["title"]):
            DB.insertVideo(table_name, video, view_count)
    DB.deleteOldData(table_name)
    DB.commit()
    if must_disconnect_db:
        DB.disconnect()

def crawlAndInsertFamousVocalovideosToDB(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None):
    """
    基本的にcrawlAndInsertToDBと処理は同じ\r\n
    差分：must_disconnect_dbがない。クロールするページの上限を無くした\r\n
    DB切断は使う側が行う必要がある\r\n
    実行する日程は決めて通常のクローリングと別の日に行ったほうがよい、使用するクォータは800程度\r\n
    再生回数の検索結果を指定したテーブルに挿入する。テーブルが整理対象であれば同時に整理も行う

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
    table_name = table_name
    search_response = crawl(word, video_duration,published_after,published_before)
    videos = search_response["items"]
    finished = False
    while True:
        for video in videos:
            view_count = getViewCount(video["id"]["videoId"])
            if view_count < filter_view_count:
                finished = True
                break
            if DB.isAlreadyInsertedItem(table_name, video):
                DB.updateViewCount("famous_vocalovideos",video["id"]["videoId"],view_count)
                continue

            if isVocaloTitle(video["snippet"]["title"]):
                DB.insertVideo(table_name, video, view_count)
        if finished:
            break
        search_response = crawl(word, video_duration,published_after,published_before,page_token=search_response["nextPageToken"])
        videos = search_response["items"]
    

    DB.commit()

def updateAllViewCountInFamousVocaloVideos():
    rows = DB.getAllVideoIdFromFamousVocaloVideos()
    for row in rows:
        video_id = row[0]
        view_count = getViewCount(video_id)
        DB.updateViewCount("famous_vocalovideos", video_id, view_count)
    DB.commit()
    DB.disconnect()
