#!/usr/bin/env python
import ipdb
import socket
import time
import urllib2

class Server:

    
    def get_webpage(self, url):
        result = urllib2.urlopen(url).read()
        return result


    def __init__(self, port):
        self.host = ''
        self.port = port
        self.proxy_request = ''
        self.www_directory = '/Users/antigen/dev/pythonNetworkProgrammingN00B/'

    def start_server(self):
        self.socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        self.socket.setsockopt(socket.SOL_SOCKET,socket.SO_REUSEADDR,1)   
        self.socket.bind((self.host, self.port))
        self._wait_for_connections()

    def _generate_headers2(self, code):
        header = ''
        if (code == 200):
            header = 'HTTP/1.1 200 OK\n'
        elif(code == 404):
            header = 'HTTP/1.1 404 Not Found\n'
        current_date = time.strftime("%a, %d %b %Y %H:%M:%S", time.localtime())
        header += 'Date: ' + current_date + '\n'
        header += 'Server: Crap-Server\n'
        header += 'Keep-Alive: timeout=5,max=100\n'
        header += 'Connection: Keep-Alive\n'
        header += 'Transfer-Encoding: chunked\n'
        header += 'Content-Type: text/html; charset=utf-8\n\n'
        return header


    def _generate_headers(self, code):
        header = ''
        if (code == 200):
            header = 'HTTP/1.1 200 OK\n'
        elif(code == 404):
            header = 'HTTP/1.1 404 Not Found\n'
        current_date = time.strftime("%a, %d %b %Y %H:%M:%S", time.localtime())
        header += 'Date: ' + current_date + '\n'
        header += 'Server: Crap-Server\n'
        header += 'Connection: close\n\n'
        return header

    def _wait_for_connections(self):
        while True:
            print "Awaiting Victims\n\n"
            self.socket.listen(2)

            conn, addr = self.socket.accept()
            print "Got connection from: ", addr
            print "*********************************************"
            data = conn.recv(1024)
            request_string = bytes.decode(data)

            print "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%"
            print repr(request_string)
            print "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%"


            request_method = request_string.split(' ')[0]
            print "Method: ", request_method
            print "Request body: ", request_string

            request_head = request_string.split('\n',1)[1]
            print "Request header: " , request_head

            if request_method == 'GET' or request_method == 'HEAD':
                file_requested = request_string.split(' ')
                file_requested = file_requested[1]

                get_request = file_requested.split('?')[0]

                if get_request == '/':
                    get_request = '/index.html'

                if "http://" in file_requested:
                    self.proxy_request = file_requested.split('?')[1]

                get_request = self.www_directory + file_requested
                print "Serving web page [", get_request, "]"

                if self.proxy_request.startswith("http://"):
                    ####
                    # call proxy server
                    ####
                    print "proxy request requested"
                    print repr(self.proxy_request)

                '''
                try: # can this be handled WITH call??
                    file_handler = open(file_requested, 'rb')
                    if request_method == 'GET':
                        response_content = file_handler.read()
                    file_handler.close()

                    response_headers = self._generate_headers(200)

                except Exception as e:
                    print "Warning, file not found. Serving response code 404\n", e
                    response_headers = self._generate_headers(404)

                    if request_method == 'GET':
                        response_content = b"<html><body><p>Error 404: File not found</p><p>Vincent's Crap HTTP server</p></body></html>"
                '''
                #################   code my add 

                ipdb.set_trace()
  
		url_request = 'http://www.myvision.hk' + file_requested
                url_header = request_head.replace('kwww.myvision.hk','54.153.63.56:8080')
                head_list = url_header.spilt('\n')
                head_dic = {}
                #a = {}
                #b = ['1:a','2:b','3:c']
                #map(lambda x:a.setdefault(x.split(':')[0], x.split(':')[1]), b)

                map(lambda x:head_dic.setdefault(x.split(':')[0], x.split(':')[1],head_list)
                rr= urllib2.Request(url_request, headers=head_dic)
                rrr = urllib2.urlopen(rr)
                res = rrr
                print rrr
                
		#res = urllib2.urlopen(url_request)
                res_body = res.read()
                res_headlist = res.info().getplist()
                
                print 'hello , foloow is the res_headlist \n' 
                print res_headlist

                res_head=''
                
                for elem in res_headlist:
                    res_head += elem + '\n'


		res_body.replace('www.myvision.hk', '54.153.63.56:8080')
                res_head.replace('www.myvision.hk', '54.153.63.56:8080')
		response_content = res_body                     
 
		response_headers = self._generate_headers2(200)

                #################
                #server_response = res_head.encode()
                server_response = ''
                server_resopnse = response_headers  # = self._generate_headers2(200)

                if request_method == 'GET':
                    server_response += response_content

                conn.send(server_response)
                print "Closing connection with client"
                conn.close()
        else:
            print "Unknown HTTP request method:", request_method

print "Starting web server\n\n"

s = Server(8080)
s.start_server()
