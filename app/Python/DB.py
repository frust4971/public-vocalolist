# coding: UTF-8
import mysql.connector
import os
import EnvSetter
import re
EnvSetter.setEnv()
conn = mysql.connector.connect(
    host=os.environ["DB_HOST"],
    port=os.environ["DB_PORT"],
    user=os.environ["DB_USERNAME"],
    password=os.environ["DB_PASSWORD"],
    database=os.environ["DB_DATABASE"]
)
cur = conn.cursor()
date_format = re.compile('\d+-\d+-\d+')
def insertVideo(table_name, video, view_count):
    #mysqlの8.023ではYouTubeから取得した日付のフォーマットでいれようとするとエラーを出されるためフォーマット調整
    published_at = date_format.match(video["snippet"]["publishedAt"]).group()
    #バインドでテーブル名を埋め込むことができなかったのでifで対応
    #テーブル名によるテーブル切り替え処理
    if table_name == "recently_famous_vocalovideos":
        cur.execute("INSERT INTO recently_famous_vocalovideos VALUES (%(video_id)s,%(title)s,%(view_count)s,%(published_at)s)",
        {"video_id": video["id"]["videoId"], "title": video["snippet"]["title"], "view_count": view_count, "published_at": published_at})
    elif table_name == "recently_famous_utattemita":
        cur.execute("INSERT INTO recently_famous_utattemita VALUES (%(video_id)s,%(title)s,%(view_count)s,%(published_at)s)",
        {"video_id": video["id"]["videoId"], "title": video["snippet"]["title"], "view_count": view_count, "published_at": published_at})
    elif table_name == "famous_vocalovideos":
        cur.execute("INSERT INTO famous_vocalovideos VALUES (%(video_id)s,%(title)s,%(view_count)s,%(published_at)s)",
        {"video_id": video["id"]["videoId"], "title": video["snippet"]["title"], "view_count": view_count, "published_at": published_at})


def isAlreadyInsertedItem(table_name, video):
    #テーブル名によるテーブル切り替え処理
    if table_name == "recently_famous_vocalovideos":
        cur.execute("SELECT video_id FROM recently_famous_vocalovideos WHERE video_id = %s", (video["id"]["videoId"],))
    elif table_name == "recently_famous_utattemita":
        cur.execute("SELECT video_id FROM recently_famous_utattemita WHERE video_id = %s", (video["id"]["videoId"],))
    elif table_name == "famous_vocalovideos":
        cur.execute("SELECT video_id FROM famous_vocalovideos WHERE video_id = %s", (video["id"]["videoId"],))

    if cur.fetchone():
        return True
    return False

def deleteOldData(table_name):
    """
    指定したテーブルのレコード数が100になるよう古いデータを消去する。テーブルが整理対象でなければ処理を行わない

    Parameters
    ----------
    table_name : string
        データを削除するテーブル名
    """
    #整理対象ではないテーブル
    if table_name == "famous_vocalovideos":
        return

    if table_name == "recently_famous_vocalovideos":
        cur.execute("SELECT COUNT(*) FROM recently_famous_vocalovideos")
    elif table_name == "recently_famous_utattemita":
        cur.execute("SELECT COUNT(*) FROM recently_famous_utattemita")

    num = cur.fetchone()[0]
    if num > 100:
        delete_num = num - 100
        if table_name == "recently_famous_vocalovideos":
            cur.execute("DELETE FROM recently_famous_vocalovideos ORDER BY published_at LIMIT %s", (delete_num,))
        elif table_name == "recently_famous_utattemita":
            cur.execute("DELETE FROM recently_famous_utattemita ORDER BY published_at LIMIT %s", (delete_num,))

def updateViewCount(video, view_count):
    cur.execute("UPDATE famous_vocalovideos SET view_count=%s WHERE video_id=%s",(view_count,video["id"]["videoId"]))

def commit():
    conn.commit()

def disconnect():
    cur.close()
    conn.disconnect()
