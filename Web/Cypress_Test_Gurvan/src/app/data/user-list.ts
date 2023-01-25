export interface User {
  id: number;
  name: string;
  password: string;
}

export const user: User[] = [
  {
    id: 1,
    name: 'admin',
    password: 'admin'
  },
  {
    id: 2,
    name: 'test',
    password: 'test'
  }
];