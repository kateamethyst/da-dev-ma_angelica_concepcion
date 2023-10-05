import { Todo, TodoInput } from '../types';
import axios from 'axios';

const request = axios.create({
  baseURL: 'http://127.0.0.1:8000',
  timeout: 15000, // Request timeout,
  withCredentials: true,
});

const getTodoList = async () => {
  const response = await request.get(
    `http://127.0.0.1:8000/api/tasks`
  );
  
  return response.data.data;
};

const addTodoList = async (todo: TodoInput) => {
  const response = await request.post(
    `/api/tasks`,
    todo
  );

  return response.data.data;
};

const updateTodoList = async (todo: TodoInput, todoId: number) => {
  const response = await request.put(
    `/api/tasks/${todoId}`,
    todo
  );

  return response.data.data;
};

const removeTodoList = async (todoId: number) => {
  const response = await request.delete(
    `/api/tasks/${todoId}`
  );

  return response.data.data;
};

export {
  getTodoList,
  addTodoList,
  updateTodoList,
  removeTodoList
}