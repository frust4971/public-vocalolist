# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import Crawler
import DB


if __name__ == "__main__":
    researchWords = ["vocaloid", "ボカロ", "ボカロ feat", "ボカロ IA", "ボカロ　ミク", "ボカロ　レン",
    "ボカロ　flower","ボカロ Lily","ボカロ　KAITO","ボカロ　miki","ボカロ　mayu"]
    for researchWord in researchWords:
        Crawler.crawlAndInsertFamousVocalovideosToDB("famous_vocalovideos", researchWord, False, "short", 1000000)
        Crawler.crawlAndInsertFamousVocalovideosToDB("famous_vocalovideos", researchWord, False, "medium", 1000000)
    DB.disconnect()