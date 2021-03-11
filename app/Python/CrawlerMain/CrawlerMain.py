import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import Crawler

#データベースを新規作成後実行するクラス
if __name__ == "__main__":
    #最近話題のボカロを集める
    recently_vocalo_published_after = (datetime.datetime.today() + relativedelta(months=-12)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    recently_vocalo_published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    Crawler.crawlAndInsertToDB("recently_famous_vocalovideos", "ボカロ 歌ってみた", True, "short", 100000, recently_vocalo_published_after, recently_vocalo_published_before)
    Crawler.crawlAndInsertToDB("recently_famous_vocalovideos","ボカロ 歌ってみた",True,"medium",100000,recently_vocalo_published_after,recently_vocalo_published_before)
    
    #最近話題の歌ってみたを集める
    recently_utattemita_published_after = (datetime.datetime.today() + relativedelta(months=-13)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    recently_utattemita_published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    Crawler.crawlAndInsertToDB("recently_famous_utattemita", "ボカロ 歌ってみた", True, "short", 100000, recently_utattemita_published_after, recently_utattemita_published_before)
    Crawler.crawlAndInsertToDB("recently_famous_utattemita","ボカロ 歌ってみた",True,"medium",100000,recently_utattemita_published_after,recently_utattemita_published_before)
    
    #ボカロTOP100を更新する
    Crawler.crawlAndInsertToDB("famous_vocalovideos", "vocaloid", False, "short", 1000000)
    Crawler.crawlAndInsertToDB("famous_vocalovideos","vocaloid",False,"medium",1000000)
    Crawler.crawlAndInsertToDB("famous_vocalovideos", "ボカロ", False, "short", 1000000)
    Crawler.crawlAndInsertToDB("famous_vocalovideos","ボカロ",False,"medium",1000000,must_disconnect_db=True)