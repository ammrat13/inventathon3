import random
import time
import socket

user = "EthanAdmin"
oxBar = 90
hrBar = 50

def get_ox_conc():
    sleepT = random.uniform(.75,1.5) # Between 40 and 80 bpm
    oxConc = random.uniform(85,100)
    time.sleep(sleepT)
    return oxConc

t = time.time()
hrlow = False
oxlow = False

while True:
    oxC = get_ox_conc()
    timest = time.time()
    
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.settimeout(5)
    s.connect(("10.27.55.90" , 80))
    
    req = b"GET /post_data.php?user=" + user.encode() + b"&timest=" + str(timest).encode() + b"&ox_content=" + str(oxC).encode() + b" HTTP/1.1\r\nHost: 10.27.55.90\r\n\r\n"
    print(req)
    s.sendall(req)
    print(s.recv(4096))
    
    # Oxygen Concentration
    if(oxC < oxBar and not oxlow):
        oxlow = True
        req = b"GET /send_alert.php?user=" + user.encode() + b"&timest=" + str(timest).encode() + b"&descr=Oxygen%20Concentration%20Low HTTP/1.1\r\nHost: 10.27.55.90\r\n\r\n"
        print(req)
        s.sendall(req)
        print(s.recv(4096))
    if(oxC > oxBar and oxlow):
        oxlow = False
        req = b"GET /send_alert.php?user=" + user.encode() + b"&timest=" + str(timest).encode() + b"&descr=Oxygen%20Concentration%20Now%20Normal HTTP/1.1\r\nHost: 10.27.55.90\r\n\r\n"
        print(req)
        s.sendall(req)
        print(s.recv(4096))
    
    hr = 60 / (timest-t)
    
    # Heart Rate
    if(hr < hrBar and not hrlow):
        hrlow = True
        req = b"GET /send_alert.php?user=" + user.encode() + b"&timest=" + str(timest).encode() + b"&descr=Heartrate%20Low HTTP/1.1\r\nHost: 10.27.55.90\r\n\r\n"
        print(req)
        s.sendall(req)
        print(s.recv(4096))
    if(hr > hrBar and hrlow):
        hrlow = False
        req = b"GET /send_alert.php?user=" + user.encode() + b"&timest=" + str(timest).encode() + b"&descr=Heartrate%20Now%20Normal HTTP/1.1\r\nHost: 10.27.55.90\r\n\r\n"
        print(req)
        s.sendall(req)
        print(s.recv(4096))
    
    t = timest
    s.close()
