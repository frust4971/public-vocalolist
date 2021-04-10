# coding: UTF-8
import sys
import os
import datetime
from dateutil.relativedelta import relativedelta
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
import crawler
import const


if __name__ == "__main__":
    crawler.update_all_view_count(const.FAMOUS_VOCALO_TABLE_NAME,must_disconnect_db=True)