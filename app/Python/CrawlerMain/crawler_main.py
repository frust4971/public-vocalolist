# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import crawler
import const



if __name__ == "__main__":
    max_results_by_view_count = 100
    max_results_by_relevance = 50
    filter_view_count = 100000
    #再生回数順で最近話題のボカロを集める
    recently_vocalo_published_after = (datetime.datetime.today() + relativedelta(months=-6)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    recently_vocalo_published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    researchWords = ["vocaloid", "ボカロ", "ボカロ feat", "ボカロ GUMI", "ボカロ IA", "初音ミク", "鏡音リン", "鏡音レン", "音街ウナ",
    "巡音ルカ","ボカロ　flower","ボカロ Lily","ボカロ　KAITO","ボカロ　miki","ボカロ　mayu","可不","歌愛ユキ"]
    for researchWord in researchWords:
        crawler.crawl_and_insert_into_db(const.RECENTLY_VOCALO_TABLE_NAME, researchWord, "short", filter_view_count, recently_vocalo_published_after, recently_vocalo_published_before,num_search=max_results_by_view_count)
        crawler.crawl_and_insert_into_db(const.RECENTLY_VOCALO_TABLE_NAME,researchWord,"medium",filter_view_count,recently_vocalo_published_after,recently_vocalo_published_before,num_search=max_results_by_view_count)

    #再生回数順で最近話題の歌ってみたを集める
    recently_utattemita_published_after = (datetime.datetime.today() + relativedelta(months=-1)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    recently_utattemita_published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME, "ボカロ 歌ってみた", "short", filter_view_count, recently_utattemita_published_after, recently_utattemita_published_before,num_search=max_results_by_view_count)
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME, "ボカロ 歌ってみた", "medium", filter_view_count, recently_utattemita_published_after, recently_utattemita_published_before,num_search=max_results_by_view_count)
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME, "ボカロ cover", "short", filter_view_count, recently_utattemita_published_after, recently_utattemita_published_before,num_search=max_results_by_view_count)
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME,"ボカロ cover","medium",filter_view_count,recently_utattemita_published_after,recently_utattemita_published_before,num_search=max_results_by_view_count)
    
    #関連度順で最近話題の歌ってみたを集める
    relative_utattemita_published_after = (datetime.datetime.today() + relativedelta(weeks=-1)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME,"ボカロ 歌ってみた","short",filter_view_count,relative_utattemita_published_after,recently_utattemita_published_before,num_search=max_results_by_relevance,order_by="relevance")
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME,"ボカロ 歌ってみた","medium",filter_view_count,relative_utattemita_published_after,recently_utattemita_published_before,num_search=max_results_by_relevance,order_by="relevance")
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME,"ボカロ cover","short",filter_view_count,relative_utattemita_published_after,recently_utattemita_published_before,num_search=max_results_by_relevance,order_by="relevance")
    crawler.crawl_and_insert_into_db(const.RECENTLY_UTATTEMIATA_TABLE_NAME,"ボカロ cover","medium",filter_view_count,relative_utattemita_published_after,recently_utattemita_published_before,num_search=max_results_by_relevance,order_by="relevance")

    #テーブルの再生回数更新
    crawler.update_all_view_count(const.RECENTLY_VOCALO_TABLE_NAME)
    crawler.update_all_view_count(const.RECENTLY_UTATTEMIATA_TABLE_NAME,must_disconnect_db=True)
