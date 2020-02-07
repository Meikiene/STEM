# Imports
import pymysql
import RPi.GPIO as GPIO
import time 

# Setup GPIO settings
GPIO.setmode(GPIO.BCM) 
GPIO.setwarnings(False) 
GPIO.setup(21,GPIO.OUT) 

# Store string to compare to associative array
offdata = "((1,),)"

# Check if loop is running
print("Loop starting...") 

# Create a loop that constantly checks the database 
while 0 == 0:
	
# Open database connection
    db = pymysql.connect(host="localhost", user="root", passwd="guzzo", db="gpioControl")

# Create a cursor object using cursor() method
    cur = db.cursor()

# Select desired value from the table
    sql = "SELECT toggleOne FROM led"

    # Execute sql statement
    cur.execute(sql)
    
    # Get data from the sql statement and store in rows
    rows = cur.fetchall() 
    
    # Show us sql statement
    print(rows)
    
    # Stringify sql statement to compare with our offdata string
    r = str(rows)
    
    # Check our data to turn off light 
    if r == offdata:
        print("LED off") 
        GPIO.output(21,GPIO.LOW) # Turn off LED
        time.sleep(1)  # Add a delay to avoid constantly reconnect/disccnnecting
    else:
        print("LED on") 
        GPIO.output(21,GPIO.HIGH) # Turn on LED
        time.sleep(1) 

# Disconnect from server
    cur.close()
    db.close()
