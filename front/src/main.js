import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import {store} from './store/store'
import cookies from "vue3-cookies"
import Cryptojs from 'crypto-js'


const app = createApp(App)
app.use(store)
app.use(cookies)
app.use(Cryptojs)
app.use(router).mount('#app')