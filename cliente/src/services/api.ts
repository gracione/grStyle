import axios from 'axios';

const api = axios.create({
  baseURL: "http://salao.localhost/",
})

const token = localStorage.getItem('token');

console.log(token);
if (token) {
  api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default api;