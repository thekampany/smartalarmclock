


#!/usr/bin/env python

from mpd import MPDClient
client = MPDClient()               # create client object
client.timeout = 10
client.connect("192.168.2.22", 6600)  # connect to localhost:6600
for i in  client.listplaylists():
   playlistname = i["playlist"]
   print(playlistname)
client.close()                     # send the close command
client.disconnect()
