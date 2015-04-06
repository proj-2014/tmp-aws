
import web
import urllib2

urls = (
'/t', 'test',
'/h', 'home',
'/.*', 'proxy'
)

app = web.application(urls, globals())

application = app.wsgifunc()

class test:

    def GET(self):
        referer = web.ctx.env.get('HTTP_REFERER', 'http://google.com')
        client_ip = web.ctx.env.get('REMOTE_ADDR')
        host = web.ctx.env.get('host')
        fullpath = web.ctx.fullpath
        user_agent = web.ctx.env.get('HTTP_USERAGENT')

        data = ""
        data += 'Client: %s<br/> \n'  % client_ip
        data += 'User-agent: %s<br/> \n'  % user_agent
        data += 'Fullpath: %s<br/> \n' % fullpath
        data += 'Referer: %s<br/> \n' % referer

        return data

    def POST(self):
        pass

class proxy:
    def GET(self):
        uri = "http://www.myvision.hk"
        host = "www.myvision.hk"
        referer = web.ctx.env.get('HTTP_REFERER','http://google.com')
        fullpath = web.ctx.fullpath
        user_agent = web.ctx.env.get('HTTP_USERAGENT')
        
        request = urllib2.Request(uri+fullpath)
        request.add_header('User_Agent', user_agent)      
        request.add_header('Host', host)
        request.add_header('Connection', 'keep-alive')
        request.add_header('Accept-Encoding','')
        
        respone = urllib2.urlopen(request)
        res_body = respone.read()
        res_head = respone.headers
        res_head_list = res_head.items()
        res_code = respone.getcode()
        print res_head
        print res_head_list
        print web.ctx.headers

        web.ctx.headers = res_head_list

        return res_body




class home:
    def GET(self):
        return "hello web.py"

    def POST(self):
        return self.GET()


if __name__ == "__main__":
    app.run()
