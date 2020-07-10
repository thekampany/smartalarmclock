
#!/bin/bash
today="`date +%Y-%m-%d`"
echo $today
grep -qF "$today" /home/pi/scripts/alarmholiday.txt && exit

todayshort="`date +%m-%d`"
grep -qF "$todayshort" /home/pi/scripts/alarmholiday.txt && exit


mpc clear
if [ $1 = "MPDPlaylist" ]
then
	mpc load $2
	mpc shuffle
fi
if [ $1 = "MPDUrl" ]
then
	mpc add $2
fi

mpc play
sleep  480
#we assume somebody will stop the alarm = press pause
while mpc status | grep paused >/dev/null
do
      mpc play
      sleep 480
      #when pressed pause in past 8 minutes then again else stop
done



