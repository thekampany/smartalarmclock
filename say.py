
import os
import sys

def Say(text):
  os.popen( 'espeak -v nl+m2 -g 10 "'+text+'" --stdout | aplay 2>/dev/null' )

Say(sys.argv[1])
