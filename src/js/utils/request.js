import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

// Create axios instance
const request = axios.create({
  baseURL: `${window.publicPath}/wp-json`,
  timeout: 10000, // Request timeout
});

// Response interceptor
request.interceptors.response.use(
  (response) => response.data,
  (error) => {
    const message = error.response.data.message;
    return Promise.reject(error);
  }
);

export default request;
