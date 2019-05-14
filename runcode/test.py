#!/usr/bin/python
# -*- coding: utf-8 -*-
import sys,os
import time
print(sys.version_info)
print(sys.executable)
print(sys.path[0])
print(os.listdir(sys.path[0]))
print(time.ctime(os.path.getmtime('D:/workspace/python/demo/test.py')))

with open("D:/workspace/python/demo/test.py") as e:
	print(e.read())
