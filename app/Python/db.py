# coding: UTF-8
import mysql.connector
import os
import env
import re
import datetime
env.load_env()
conn = mysql.connector.connect(
    host=os.environ["DB_HOST"],
    port=os.environ["DB_PORT"],
    user=os.environ["DB_USERNAME"],
    password=os.environ["DB_PASSWORD"],
    database=os.environ["DB_DATABASE"]
)
cur = conn.cursor()
date_format = re.compile('\d+-\d+-\d+')

def get_safe_table_name(table_name):
    """
    安全なテーブル名を返す\r\n
    テーブル名の埋め込みがプレースホルダーでは出来ないため必要
    """
    if table_name == "recently_famous_vocalovideos":
        return "recently_famous_vocalovideos"
    elif table_name == "recently_famous_utattemita":
        return "recently_famous_utattemita"
    elif table_name == "famous_vocalovideos":
        return "famous_vocalovideos"
    elif table_name == "not_vocalovideos":
        return "not_vocalovideos"
    else:
        raise ValueError("テーブル名が適切ではありません")

def is_inserted_item(table_name, video_id):
    table_name = get_safe_table_name(table_name)
    sql = "SELECT video_id FROM {} WHERE video_id = %s".format(table_name)
    cur.execute(sql, (video_id,))
    if cur.fetchone():
        return True
    return False

def insert_video(table_name, video, view_count):
    if is_inserted_item('not_vocalovideos', video["id"]["videoId"]):
        return
    table_name = get_safe_table_name(table_name)
    sql = "INSERT INTO {} (video_id,title,view_count,published_at) VALUES (%(video_id)s,%(title)s,%(view_count)s,%(published_at)s)".format(table_name)
    #mysqlの8.023ではYouTubeから取得した日付のフォーマットでいれようとするとエラーを出されるためフォーマット調整
    published_at = date_format.match(video["snippet"]["publishedAt"]).group()
    cur.execute(sql, {"video_id": video["id"]["videoId"], "title": video["snippet"]["title"], "view_count": view_count, "published_at": published_at})
    
def delete_old_data(table_name):
    """
    指定したテーブルのレコード数が100になるよう古いデータを消去する。テーブルが整理対象でなければ処理を行わない
    """
    #整理対象ではないテーブル
    if table_name == "famous_vocalovideos":
        return
    table_name = get_safe_table_name(table_name)
    sql = "SELECT COUNT(*) FROM {}".format(table_name)
    cur.execute(sql)

    num = cur.fetchone()[0]
    if num > 100:
        delete_num = num - 100
        sql = "DELETE FROM {} ORDER BY published_at LIMIT %s".format(table_name)
        cur.execute(sql,(delete_num,))

def update_view_count(table_name, video_id, view_count):
    table_name = get_safe_table_name(table_name)
    sql = "UPDATE {} SET view_count=%s WHERE video_id=%s".format(table_name)
    cur.execute(sql,(view_count,video_id))

def get_all_video_id_from_famous_vocalovideos():
    cur.execute("SELECT video_id FROM famous_vocalovideos")
    rows = cur.fetchall()
    return rows
        
def delete_and_insert_into_not_vocalovideos(video_id):
    """
    検索条件に引っかかるがボカロではない動画を歴代ボカロランキングテーブルから削除する\r\n
    同時にボカロでない動画を集めるテーブルに入れ、以降は歴代ボカロランキングに入れないようにする\r\n
    """
    if is_inserted_item("not_vocalovideos",video_id):
        return
    cur.execute("DELETE FROM famous_vocalovideos WHERE video_id = %s",(video_id,))
    cur.execute("INSERT INTO not_vocalovideos VALUES (%s)", (video_id,))

def commit():
    conn.commit()

def disconnect():
    cur.close()
    conn.disconnect()

