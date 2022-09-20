import './bootstrap';
import { createApp } from 'vue';
import vuetify from '@/plugins/vuetify.js'
import router from '@/router/index.js'
import App from '@/App.vue'
const app = createApp(App);

app.use(vuetify)
app.use(router)
app.mount("#app");
