import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Button from "./components/ButtonView.vue"
import './assets/tailwind.css'

createApp(App).use(router).mount('#app')
.component("Button-View",Button)
