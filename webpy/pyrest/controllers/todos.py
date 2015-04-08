# coding: utf-8
import web
from modules.json_controller import JSONController
from modules.json_form import (JSONForm, NotFoundError,
                               BooleanInput, StringInput)


#todo_id = "123456"



class Todos(JSONController):
    
    Form = JSONForm(
        BooleanInput('is_done'),
        StringInput(
            'content',
            web.form.Validator('Content length must be greater than 7',
                               lambda s: len(s) > 7)
        ),
    )
    
    def list(self):
        '''Select todos from database'''
        return web.ctx.db.select('todos').list()

    def get(self, todo_id):
        '''Select todo by id'''
        print  'now in Todos.get'

        todo = web.ctx.db.select('todos', where="id = $todo_id",
                                 vars=locals()).list()
        if todo:
            return todo[0]
        else:
            raise NotFoundError()

    def create(self):
        '''Create new todo'''
        
        form = self.Form()
        if form.validates():
            todo_id = web.ctx.db.insert('todos', **form.d)
            return self.get(todo_id)
        '''
        source = json.loads(web.data())
        todo_id = web.ctx.db.insert('todos', source)
        return self.get(todo_id)
        '''

    def update(self, todo_id):
        '''Update todo by id and return it'''
        
        form = self.Form()
        if form.validates():
            todo = self.get(todo_id)
            web.ctx.db.update('todos', where='id = $todo_id',
                              vars=locals(), **form.d)
            todo.update(**form.d)
            return todo
        '''
        todo = self.get(todo_id)
        source = json.loads(web.data())
#        web.ctx.db.update('todos', where='id = $todo_id',
#                          vars=locals(), source)
        todo.update(source)
        return todo
        '''


    def delete(self, todo_id):
        '''Delete todo by id and return deleted todo'''
        todo = self.get(todo_id)
        web.ctx.db.delete('todos', where='id = $todo_id', vars=locals())
        return todo
