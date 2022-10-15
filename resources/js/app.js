import './bootstrap';
import { createApp } from 'vue';
import { Quasar, Notify } from 'quasar'
import '@/quasar/quasar.js'
import router from '@/router/index.js'
import store from './store'
import App from '@/App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import "@/assets/css/style.css"

const app = createApp(App);


const components = import.meta.globEager(['@/layouts/*.vue', '@/components/forms/*.vue'])

Object.entries(components).forEach(([path, definition]) => {
  const componentName = path.split('/').pop().replace(/\.\w+$/, '')
  app.component(componentName, definition.default)
})

app.use(Quasar, {
  plugins: {Notify},
  config: {
    notify: {position: 'top-right',
    timeout: 600}
  }
})

app.use(VueAxios, axios)
app.use(store)
app.use(router)
app.mount("#app");
