import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import {store} from './store/store'
import {cookie} from "vue3-cookies"


const app = createApp(App)
app.use(store)
app.use(cookie)
app.use(router).mount('#app')