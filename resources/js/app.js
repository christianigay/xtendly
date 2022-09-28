import './bootstrap';
import { createApp } from 'vue';
import router from '@/router/index.js'
import store from './store'
import App from '@/App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp(App);

const components = import.meta.globEager('@/layouts/*.vue')

Object.entries(components).forEach(([path, definition]) => {
  const componentName = path.split('/').pop().replace(/\.\w+$/, '')
  app.component(componentName, definition.default)
})

app.use(VueAxios, axios)
app.use(store)
app.use(router)
app.mount("#app");
