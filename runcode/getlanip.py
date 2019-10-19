# https://pypi.org/project/websocket_client/ 
import socket
import os
import urllib.request
import json
import urllib.parse
from websocket import create_connection

def get_lan_ip():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(("1.1.1.1",80))
    ipaddr=s.getsockname()[0]
    s.close()
    return ipaddr

def send_tcp_server():
    ss = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    ss.connect(('workman-chat.mynep.com', 7272))
    #f=open('aa','wb')
    msg = 'tom'
    ss.sendall(msg.encode('utf-8'))
    #os.system('sleep 1')
    #ss.send('FOE')
    data = ss.recv(1024)
    print('server dafu %s' % data.decode())
    ss.close()

def send_websocket_server(data):   
    ws = create_connection("ws://127.0.0.1:2000/") # workerman的websocket服务端
    print("Sending 'Hello, World'...")
    msg = {"lanip": data,"username":'admin',"msgtype":'setip'}
    ws.send(json.dumps(msg))
    print("Sent")
    print("Receiving...")
    result = ws.recv()
    print("Received '%s'" % result)
    ws.close()

if __name__ == '__main__':
    lanip=get_lan_ip()
    print(lanip)
    # url = 'http://192.168.1.4/1.txt'
    # f = urllib.request.urlopen(url)
    # print(f.read().decode('utf-8'))
    send_websocket_server(lanip)
