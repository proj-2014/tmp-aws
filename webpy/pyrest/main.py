


#import web
#from urls import urls
#from config import config

#--------------------------------------------------------------
#setting.py

import os
import sys

import web
from web.contrib.template import  render_jinja
from jinja2 import Environment,FileSystemLoader

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
    jinja_env=Environment(
        loader=FileSystemLoader(template_dir),
        extensions=extensions)   
    jinja_env.globals.update(globals)
    return jinja_env.get_template(template_name).render(context)

#--------------------------------------------------------------
#views.py

class Test:
    def GET(self):
        #return render.test(input="abc")
        return render_template("test.html",input="def")

#--------------------------------------------------------------
#urls.py

urls = (
'/api/todos(?:/(?P<todo_id>[0-9]+))?', 'controllers.todos.Todos',
'/', 'controllers.index.Index',
'/test', 'Test'
)


#--------------------------------------------------------------
#main.py

app = web.application(urls, globals())

def ctx_hook():
    web.ctx.db = db

app.add_processor(web.loadhook(ctx_hook))

if __name__ == '__main__':
    app.run()
