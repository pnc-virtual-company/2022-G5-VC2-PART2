import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import BaseCard from './components/widgets/Card/BaseCard.vue';
import FormClassBatch from './components/widgets/form_create/CreateBatchClass.vue';
import ButtonCreate from './components/widgets/button/ButtonCreate.vue';
import ButtonCancel from './components/widgets/button/ButtonCancel.vue';

const app = createApp(App);

app.component('base-card', BaseCard);
app.component('class-batch', FormClassBatch);
app.component('button-create', ButtonCreate);
app.component('button-cancel', ButtonCancel);
app.use(router)
app.mount('#app')

