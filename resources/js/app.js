import './bootstrap';
import App from './App.vue'
import '../scss/_general.scss'
import { createApp } from 'vue';
import router from './router/index';

const app = createApp(App)
app.use(router)
app.mount('#app')
