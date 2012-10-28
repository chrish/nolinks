#!/usr/bin/python

import MySQLdb
import sys
import time 
import os, oursql

start_time = time.time()

data = open("../../data.txt", "r")
sql = "INSERT INTO nolinks (pagetitle, pagelen) VALUES (?, ?)"

db = oursql.connect(db='u_bjelleklang',
        host="sql",
        read_default_file=os.path.expanduser("~/.my.cnf"),
        charset=None,
        use_unicode=False
)

cursor = db.cursor()
i = 0


for line in data:
    words = line.split('\t')
    cursor.execute(sql, (words[0], words[3]))
    cursor.execute("commit")

cursor.close ()
conn.close ()
print time.time() - start_time, "seconds"

