import mysql.connector

def query_db(query: str):
    db_con = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="test",
    )
    db_cursor = db_con.cursor()
    db_cursor.execute(query)
    rows = db_cursor.fetchall()
    db_con.commit()
    db_con.close()
    return rows

def init_db():
    query_db(
        """CREATE TABLE IF NOT EXISTS data(id INTEGER PRIMARY KEY AUTOINCREMENT, message_type TEXT, message TEXT);"""
    )

if __name__ == '__main__':
    init_db()