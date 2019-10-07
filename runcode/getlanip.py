import socket
import urllib.request
import urllib.parse

def get_lan_ip():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(("1.1.1.1",80))
    ipaddr=s.getsockname()[0]
    s.close()
    return ipaddr

if __name__ == '__main__':
    lanip=get_lan_ip()
    print(lanip)
    url = 'http://192.168.1.4/1.txt'
    f = urllib.request.urlopen(url)
    print(f.read().decode('utf-8'))