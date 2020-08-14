import csv
from datetime import datetime
import subprocess

#print (datetime.today().date().strftime("%d-%m"))

with open('/var/www/html/alarmclock/birthday.txt', mode='r') as csv_file:
    csv_reader = csv.DictReader(csv_file)
    line_count = 0
    for row in csv_reader:
        if line_count == 0:
            #skip columnnames
            line_count += 1
        if row["birthday"] == datetime.today().date().strftime("%d-%m"):
            #print(row["name"])
            birthdaytext = "Vandaag is het de verjaardag van: "+row['name']
            subprocess.call(["python","/var/www/html/alarmclock/say.py",birthdaytext])
        line_count += 1
