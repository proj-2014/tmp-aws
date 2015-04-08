


import os
import sys
import web
#from urls import urls
#from config import config


sys.path.append(os.path.abspath(os.path.dirname(__file__)))

urls = (
'/api/todos(?:/(?P<todo_id>[0-9]+))?', 'controllers.todos.Todos',

#'/api/todos', 'controllers.todos.Todos',
'/', 'controllers.index.Index'
)


app = web.application(urls, globals())

database = "db.sqlite"
db = web.database(dbn='sqlite', db=database)

def ctx_hook():
    web.ctx.db = db

app.add_processor(web.loadhook(ctx_hook))

if __name__ == '__main__':
    app.run()
