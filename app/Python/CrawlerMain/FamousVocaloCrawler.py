# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import Crawler
import DB

def crawlAndInsertFamousVocalovideosToDB(table_name, word, is_utattemita, video_duration, filter_view_count, published_after=None, published_before=None):
    """
    基本的にCrawlerのcrawlAndInsertToDBと処理は同じ\r\n
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
    search_response = Crawler.crawl(word, video_duration,published_after,published_before)
    videos = search_response["items"]
    finished = False
    while True:
        for video in videos:
            view_count = Crawler.getViewCount(video)
            if view_count < filter_view_count:
                finished = True
                break
            if DB.isAlreadyInsertedItem(table_name, video):
                DB.updateViewCount(video,view_count)
                continue

            if Crawler.isVocaloTitle(video["snippet"]["title"]):
                DB.insertVideo(table_name, video, view_count)
        if finished:
            break
        search_response = Crawler.crawl(word, video_duration,published_after,published_before,page_token=search_response["nextPageToken"])
        videos = search_response["items"]
    

    DB.commit()
if __name__ == "__main__":
    researchWords = ["vocaloid", "ボカロ", "ボカロ feat", "ボカロ GUMI", "ボカロ IA", "ボカロ　ミク", "ボカロ　リン", "ボカロ　レン", "ボカロ　ウナ",
    "ボカロ　ルカ","ボカロ　flower","ボカロ Lily","ボカロ　KAITO","ボカロ　miki","ボカロ　mayu"
    ]
    for researchWord in researchWords:
        crawlAndInsertFamousVocalovideosToDB("famous_vocalovideos", researchWord, False, "short", 1000000)
        crawlAndInsertFamousVocalovideosToDB("famous_vocalovideos", researchWord, False, "medium", 1000000)
    DB.disconnect()
    