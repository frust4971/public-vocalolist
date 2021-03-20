# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import Crawler
import DB


if __name__ == "__main__":
    Crawler.updateAllViewCountInFamousVocaloVideos()