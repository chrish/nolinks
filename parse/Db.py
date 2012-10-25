#!/usr/bin/python

import MySQLdb

class Db

	def __init__(self):
	
	def connect(self):
		conn = MySQLdb.connect (host = "localhost",
					user = "",
					passwd = "",
					db = "")
		return conn.cursor()
