import React, { useEffect, useState } from 'react';
import TodoInputText from '../../components/text';
import { getTodoList } from '../../api/todolist';
import Item from '../../components/item';
import List from '../../components/list';
import { Todo } from '../../types';
import { filter } from 'lodash';

export const TodoList = () => {

  const [completedTodos, setCompletedTodos] = useState<Todo[]>([]);
  const [inProgressTodos, setInProgressTodos] = useState<Todo[]>([]);

  useEffect( () => {
    fetchTodoList();
  }, []);

  const fetchTodoList = async () => {
    const todos: Todo[] = await getTodoList();
    
    setCompletedTodos(filter(todos, (todo) => todo.isCompleted));
    setInProgressTodos(filter(todos, (todo) => !todo.isCompleted));
  }

  const onSubmit = async () => {
    await fetchTodoList();
  }

  return (
    <div className="p-24">
      <div className="grid grid-cols-12 grid-rows-1 gap-4">
        <div className="col-span-4">
          <h1 className='text-5xl mb-10 text-gray-800 font-bold'>Todo List App</h1>
          <TodoInputText onSubmit={onSubmit}/>

          <div className='p-4 border rounded'>
            <p className="font-bold text-gray-600">Instructions</p>
            <ul>
              <li className="text-sm text-gray-600">Click on checkbox to mark the todo as complete or in progress.</li>
              <li className="text-sm text-gray-600">Click on x button to remove the todo from the list.</li>
            </ul>
          </div>
        </div>
        <div className="col-span-4 col-start-5">
          <List todos={inProgressTodos} title="in progress" fetchTodoList={fetchTodoList} />
        </div>
        <div className="col-span-4 col-start-9">
          <List todos={completedTodos} title="completed" fetchTodoList={fetchTodoList} />
        </div>
      </div>
    </div>
  );
};

export default TodoList;