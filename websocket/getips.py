import os

from socket import gethostbyname, gethostname

# 获取本机IP地址

host = gethostbyname(gethostname())
#host = '10.82.97.232'
print(host)
print(gethostname())

# 获取ARP表

os.system('arp -a > temp.txt')

with open('temp.txt') as fp:

	for line in fp:
		line1 = line.split()[:2]

		if line1 and line1[0].startswith(host[:4]) and (not line1[0].endswith('255')):
			print(':'.join(line1))
		#else:
			#print(':'.join(line1))
		#print(line)