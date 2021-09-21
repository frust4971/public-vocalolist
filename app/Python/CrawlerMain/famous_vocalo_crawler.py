# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import crawler
import db
import const


if __name__ == "__main__":
    published_after = (datetime.datetime.today() + relativedelta(years=-6)).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    published_before = (datetime.datetime.today()).strftime('%Y-%m-%dT%H:%M:%S.%fZ')
    researchWords = ["vocaloid", "ボカロ", "ボカロ feat", "ボカロ GUMI", "鏡音リン", "音街ウナ",
    "巡音ルカ", "ボカロ IA","ボカロ　flower"]
    for researchWord in researchWords:
        crawler.crawl_and_insert_famous_vocalovideos_into_db(const.FAMOUS_VOCALO_TABLE_NAME, researchWord, "short", 1000000,published_after,published_before)
        crawler.crawl_and_insert_famous_vocalovideos_into_db(const.FAMOUS_VOCALO_TABLE_NAME, researchWord, "medium", 1000000,published_after,published_before)
    db.disconnect()
    