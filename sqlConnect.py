#import MySQLdb
import mysql.connector

# Open database connection
db = mysql.connector.connect(host="localhost",user="user",passwd="password",db="school" )

# prepare a cursor object using cursor() method.
cursor = db.cursor()

cur = db.cursor(dictionary=True)

# cursor = db.cursor(mysql.connector.cursors.DictCursor)

# Create a table as per requirement
sql = "SELECT * from students"

# execute SQL query using execute() method.
cur.execute(sql)

#fetch all data and print 
rows = cur.fetchall()
for row in rows:
	print(row)

# disconnect from server
db.close()
