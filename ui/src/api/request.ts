import axios from 'axios';

const request = axios.create({
  baseURL: 'http://127.0.0.1:8000',
  timeout: 15000, // Request timeout,
  withCredentials: true,
});

export const longRequest = axios.create({
  timeout: 90000, // Request timeout (90 seconds),
  withCredentials: true,
});

export default request;
