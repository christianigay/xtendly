import { createRouter,createWebHistory} from 'vue-router'
import home from './home'
import auth from './auth'
import payment from './payment'
import product from './product'
import cart from './cart'

const routes = [
    ...home,
    ...auth,
    ...payment,
    ...product,
    ...cart
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router