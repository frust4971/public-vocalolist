# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import crawler
import db


if __name__ == "__main__":
    researchWords = ["vocaloid", "ボカロ", "ボカロ feat", "ボカロ GUMI", "ボカロ　リン", "ボカロ　ウナ",
    "ボカロ　ルカ", "ボカロ IA","ボカロ　flower"]
    for researchWord in researchWords:
        crawler.crawl_and_insert_famous_vocalovideos_into_db("famous_vocalovideos", researchWord, False, "short", 1000000)
        crawler.crawl_and_insert_famous_vocalovideos_into_db("famous_vocalovideos", researchWord, False, "medium", 1000000)
    db.disconnect()
    