import { createRouter,createWebHistory} from 'vue-router'
import home from './home'
import auth from './auth'
import payment from './payment'

const routes = [
    ...home,
    ...auth,
    ...payment
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router