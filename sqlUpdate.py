#import MySQLdb
import mysql.connector

# Open database connection
db = mysql.connector.connect(host="localhost",user="user",passwd="password",db="school" )

# prepare a cursor object using cursor() method.
cursor = db.cursor()

cur = db.cursor(dictionary=True)

sql = "UPDATE students SET age=17 WHERE name='Akali'" 

# execute SQL query using execute() method.
cur.execute(sql)

# disconnect from server
cur.close()
db.close()


