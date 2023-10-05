import React, { useState } from 'react';
import { addTodoList } from '../api/todolist';

type Props = {
  onSubmit: () => void;
};

export const TodoInputText = ({onSubmit}: Props) => {

  const [todo, setTodo] = useState<string>('');

  const handleOnChangeTodo = (e: any) => {
    setTodo(e.target.value)
  };

  const handleOnKeydown = async (event: any) => {
    if (event.key === 'Enter' && todo.trim() !== '') {
      await addTodoList({description: todo, isCompleted: false});
      setTodo('');
      onSubmit()
    }
  }

  return (
    <>
        <input
          type="text"
          value={todo}
          placeholder="Type here..."
          className="text-2xl p-1 border-b w-full focus:outline-none"
          onChange={handleOnChangeTodo}
          onKeyDown={handleOnKeydown}
        />
        <p className='text-sm italic text-neutral-400 mb-10'>Press enter to add your todo</p>
    </>
  );
};

export default TodoInputText;