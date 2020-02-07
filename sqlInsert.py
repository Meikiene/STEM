#import MySQLdb
import mysql.connector

# Open database connection
db = mysql.connector.connect(host="localhost",user="user",passwd="password",db="school" )

# prepare a cursor object using cursor() method.
cursor = db.cursor()

cur = db.cursor(dictionary=True)

name='Akali'
age = 17
gradeLevel = 11

# Create a table as per requirement
sql = "INSERT INTO students (name,age,gradeLevel) VALUES('Akali',17,11)"

# execute SQL query using execute() method.
cur.execute(sql)

# disconnect from server
cur.close()
db.close()

