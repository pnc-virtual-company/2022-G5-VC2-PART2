import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import BaseCard from './components/widgets/Card/BaseCard.vue';
import ButtonAdd from './components/widgets/button/ButtonAdd.vue';

const app = createApp(App);

app.component('base-card', BaseCard);
app.component('base-button', ButtonAdd);
app.use(router)
app.mount('#app')

