
from datetime import datetime
import time
import json
import subprocess

while True:
	now = datetime.now()
	current_time = now.strftime("%H:%M")
	#print("Current Time =", now.strftime("%H:%M:%S"))

	current_weekday = datetime.today().weekday()
	#print("Current Day =", current_weekday)

	f = open('/var/www/html/alarmclock/alarm.conf.json',)
	data = json.load(f)
	todaysalarmdetails = data['Alarmdetails'][current_weekday]
	f.close()

	if (todaysalarmdetails['AlarmDayEnabled'] == 'True'):
		todaysalarmtime = todaysalarmdetails['AlarmTime']
		#print (todaysalarmtime)
		if (current_time == todaysalarmtime):
			print("alarm")
			print(todaysalarmdetails['AlarmMethod'])
			print(todaysalarmdetails['AlarmMethodValue'])
                        process = subprocess.Popen(['sh', '/var/www/html/alarmclock/goalarm.sh',todaysalarmdetails['AlarmMethod'], todaysalarmdetails['AlarmMethodValue']],stdout=subprocess.PIPE,stderr=subprocess.PIPE)
			break
		#else :
			#print("no alarm now")
                        #process = subprocess.Popen(['sh', '/home/pi/scripts/testalarm.sh',todaysalarmdetails['AlarmMethod'], todaysalarmdetails['AlarmMethodValue']],stdout=subprocess.PIPE,stderr=subprocess.PIPE)
			#stdout, stderr = process.communicate()
			#print(stdout)
	#else :
		#print ("no alarm today")

	time.sleep(60)




