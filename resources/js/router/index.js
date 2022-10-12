import { createRouter,createWebHistory} from 'vue-router'
import home from './home'
import auth from './auth'
import payment from './payment'
import product from './product'

const routes = [
    ...home,
    ...auth,
    ...payment,
    ...product
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router