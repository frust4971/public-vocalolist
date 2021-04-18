import db
if __name__ == "__main__":
    db.reset_mail_users_table()
    db.commit()
    db.disconnect()