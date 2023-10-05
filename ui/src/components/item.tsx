import React, { useEffect } from 'react';
import { Todo } from '../types';
import { removeTodoList, updateTodoList } from '../api/todolist';

type Props = {
  todo: Todo,
  refresh: () => void;
}

const Item = ( { todo, refresh } : Props ) => {
  const handleOnRemove = async () => {
    await removeTodoList(todo.id);
    refresh();
  }

  const handleOnChange = async () => {
    await updateTodoList({
      description: todo.description,
      isCompleted: !todo.isCompleted
    }, todo.id);
    refresh();
  }

  return (
      <li className='p-3 border flex justify-between my-2 rounded'>
        <label className={`${todo.isCompleted && 'line-through italic'} flex`}>
          <input type="checkbox" onChange={handleOnChange} checked={todo.isCompleted} title="Mark todo as complete"/>
          <span className='px-2 text-gray-600 whitespace-normal'>{todo.description}</span>
        </label>
        <button type="button" className="font-bold text-xs rounded text-gray-600" title="Remove" onClick={handleOnRemove}>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-x" viewBox="0 0 16 16">
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        </button>
      </li>
  );
};

export default Item;