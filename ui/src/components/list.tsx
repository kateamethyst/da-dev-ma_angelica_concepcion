import React from 'react';
import { Todo } from '../types';
import Item from '../components/item';

type Props = {
  todos: Todo[],
  title: string,
  fetchTodoList: () => void;
}

export const List = ({todos, title, fetchTodoList}: Props) => {
  return (
    <>
      <p className='font-bold text-xl pb-8 text-gray-600 capitalize'>{title} ({todos.length})</p>
      {
        todos.length === 0 ? (
          <p className="italic text-neutral-500 text-center">No <span className='lowercase'>{title}</span> todos.</p>
        ) : (
          <ul>
            {
              todos?.map((todo: Todo, index: number) => (
                <Item todo={todo} key={index} refresh={fetchTodoList}/>
              ))
            }
          </ul>
        )
      }
    </>
  );
}

export default List;