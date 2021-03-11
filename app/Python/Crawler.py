# coding: UTF-8
import re
import os
from googleapiclient import build
import datetime
from dateutil.relativedelta import relativedelta
import EnvSetter
import DB


EnvSetter.setEnv()
API_KEY = os.environ["YOUTUBE_API_KEY"]
youtube = build("youtube","v3",developerKey=API_KEY)
def isVocaloTitle(title):
    if re.match('.*オリジナル曲.*',title):
        return True
    notVocaloPattern = re.compile('.*(歌|cover|演奏|メドレー|ランキング|再生|神曲|合唱|太鼓|remix|曲|弾い|みた|バンド|クイズ|反応|検定|テスト).*',re.IGNORECASE)
    if notVocaloPattern.match(title):
        return False
    return True

def isUtatteMitaTitle(title):
    notUtatteMitaPattern = re.compile('.*(ランキング|メドレー|替え歌|再生).*',re.IGNORECASE)
    if notUtatteMitaPattern.match(title):
        return False
    return True

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

def getViewCount(video):
    response = youtube.videos().list(
        part="statistics",
        id=video["id"]["videoId"],
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
    table_name = table_name
    search_response = crawl(word, video_duration,published_after,published_before)
    videos = search_response["items"]
    finished = False
    while True:
        counter += 1 
        for video in videos:
            view_count = getViewCount(video)
            if view_count < filter_view_count:
                finished = True
                break
            if DB.isAlreadyInsertedItem(table_name, video):
                if table_name == "famous_vocalovideos":
                    DB.updateViewCount(video,view_count)
                continue

            if is_utattemita and isUtatteMitaTitle(video["snippet"]["title"]):
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

