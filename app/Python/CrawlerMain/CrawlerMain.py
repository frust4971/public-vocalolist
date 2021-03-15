# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import Crawler

#データベースを新規作成後実行するクラス
if __name__ == "__main__":
    #最近話題のボカロを集める
    recently_vocalo_published_after = (datetime.datetime.today() + relativedelta(months=-6)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    recently_vocalo_published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    researchWords = ["vocaloid", "ボカロ", "ボカロ feat", "ボカロ GUMI", "ボカロ IA", "ボカロ　ミク", "ボカロ　リン", "ボカロ　レン", "ボカロ　ウナ",
    "ボカロ　ルカ","ボカロ　flower","ボカロ Lily","ボカロ　KAITO","ボカロ　miki","ボカロ　mayu"]
    for researchWord in researchWords:
        Crawler.crawlAndInsertToDB("recently_famous_vocalovideos", researchWord, False, "short", 100000, recently_vocalo_published_after, recently_vocalo_published_before)
        Crawler.crawlAndInsertToDB("recently_famous_vocalovideos",researchWord,False,"medium",100000,recently_vocalo_published_after,recently_vocalo_published_before)
    
    #最近話題の歌ってみたを集める
    recently_utattemita_published_after = (datetime.datetime.today() + relativedelta(months=-6)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    recently_utattemita_published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    Crawler.crawlAndInsertToDB("recently_famous_utattemita", "ボカロ 歌ってみた", True, "short", 100000, recently_utattemita_published_after, recently_utattemita_published_before)
    Crawler.crawlAndInsertToDB("recently_famous_utattemita", "ボカロ 歌ってみた", True, "medium", 100000, recently_utattemita_published_after, recently_utattemita_published_before)
    Crawler.crawlAndInsertToDB("recently_famous_utattemita", "ボカロ cover", True, "short", 100000, recently_utattemita_published_after, recently_utattemita_published_before)
    Crawler.crawlAndInsertToDB("recently_famous_utattemita","ボカロ cover",True,"medium",100000,recently_utattemita_published_after,recently_utattemita_published_before)
    
    Crawler.crawlOrderByRelevanceAndInsertToDB("recently_famous_utattemita","ボカロ 歌ってみた",True,"short",100000,recently_utattemita_published_after,recently_utattemita_published_before)
    Crawler.crawlOrderByRelevanceAndInsertToDB("recently_famous_utattemita","ボカロ 歌ってみた",True,"medium",100000,recently_utattemita_published_after,recently_utattemita_published_before)
    Crawler.crawlOrderByRelevanceAndInsertToDB("recently_famous_utattemita","ボカロ cover",True,"short",100000,recently_utattemita_published_after,recently_utattemita_published_before)
    Crawler.crawlOrderByRelevanceAndInsertToDB("recently_famous_utattemita","ボカロ cover",True,"medium",100000,recently_utattemita_published_after,recently_utattemita_published_before,must_disconnect_db=True)

