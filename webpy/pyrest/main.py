


#import web
#from urls import urls
#from config import config

#--------------------------------------------------------------
#setting.py

import os
import sys

import web
from web.contrib.template import  render_jinja
from jinja2 import Environment,FileSystemLoader,ChoiceLoader

sys.path.append(os.path.abspath(os.path.dirname(__file__)))

rootdir = os.path.abspath(os.path.dirname(__file__))
sys.path.append(rootdir)

static_dir= rootdir + '/static'
template_dir= rootdir + '/templates'

# config database
database = "db.sqlite"
db = web.database(dbn='sqlite', db=database)
#db = web.database(dbn='mysql', db='test', user='root', pw='')

#config template 
render = render_jinja(template_dir, encoding = 'utf-8')

def render_template(template_name,**context):
    extensions=context.pop('extensions',[])
    globals=context.pop("globals",{})
    '''
    jinja_env=Environment(
        loader=FileSystemLoader(template_dir),
        extensions=extensions)   
    '''
    '''
    #jinja_dirs = [ jinja2.FileSystemLoader(dirname) for dirname in sub_dirs ]
    jinja_dirs = [ jiaja2.FileSystemLoader('/static/templates'), jiaja2.FileSystemLoader(template_dir) ]
    jinja_env = jinja2.Environment (loader = jinja2.ChoiceLoader(jinja_dirs))
    '''
    loader = ChoiceLoader([FileSystemLoader(os.path.join(rootdir, 'templates')),
                                     FileSystemLoader(os.path.join(rootdir, 'static', 'templates'))])
    jiaja_env = Environment( loader=loader, extensions=extensions)
    jinja_env.globals.update(globals)

    return jinja_env.get_template(template_name).render(context)


#--------------------------------------------------------------
#views.py

class Test:
    def GET(self):
        #return render.test(input="abc")
        return render_template("test.html",input="def")

class bootst:
    def GET(self):
        return render.bootst()


class numj:
    def GET(self):
        items = [{
            'title': 'Facebook',
            'body': 'Facebook is a social utility that connects people with friends and others who work, study and live around them.'
        }, {
            'title': 'Twitter',
            'body': 'Twitter is an online social networking and microblogging service that enables users to send and read "tweets", which are text messages limited to 140 characters.'
        }, {
            'title': 'LinkedIn',
            'body': 'LinkedIn is a social networking website for people in professional occupations.'
        }];
        return render.numj(items=items)
#--------------------------------------------------------------
#urls.py

urls = (
'/api/todos(?:/(?P<todo_id>[0-9]+))?', 'controllers.todos.Todos', #test rest
'/', 'controllers.index.Index',  # test basic url 
'/test', 'Test',   # test jinja2
'/bs', 'bootst',   # test bootstrap
'/nj', 'numj'      # test numjucks  , share same template with jinja2 
)


#--------------------------------------------------------------
#main.py

app = web.application(urls, globals())

def ctx_hook():
    web.ctx.db = db

app.add_processor(web.loadhook(ctx_hook))

if __name__ == '__main__':
    app.run()
