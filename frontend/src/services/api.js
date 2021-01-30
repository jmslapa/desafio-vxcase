import axios from 'axios';

const api = axios.create({
  baseURL: 'http://vxcase.test/api/',
});

export default api;
