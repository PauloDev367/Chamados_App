import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css'

import toastrPlugin from '@/services/toastr';
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

createApp(App)
    .use(toastrPlugin)
    .use(router)
    .mount('#app')
