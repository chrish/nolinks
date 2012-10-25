#!/usr/bin/python

import MySQLdb
import sys
import time 
import Db

start_time = time.time()

data = open("../../data.txt", "r")
sql = "INSERT INTO nolinks (pageTitle) VALUES (%s)"
cursor = Db.connect()
i = 0



for line in data:
	words = line.split('\t')
	cursor.execute(sql, words[0])
	cursor.execute("commit")

cursor.close ()
conn.close ()
print time.time() - start_time, "seconds"

