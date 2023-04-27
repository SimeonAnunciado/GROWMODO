import { createApp } from 'vue'
import axios from 'axios';
import App from './App.vue';
import router from './router';
import store from './store'

window.axios = axios;

let token = localStorage.getItem('access_token') ?? null;
window.axios.create({
    baseURL: 'https://agile-atoll-85704.herokuapp.com',
});

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
if(token != null) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}` ;
}



createApp(App)
.use(router)
.use(store)
.mount('#app')