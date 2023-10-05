export type Todo = {
  id: number,
  description: string,
  isCompleted: boolean,
  createdAt: string,
  updatedAt: string,
}
export type TodoInput = {
  description: string,
  isCompleted: boolean,
}