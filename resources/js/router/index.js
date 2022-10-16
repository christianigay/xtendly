import { createRouter,createWebHistory} from 'vue-router'
import home from './home'
import auth from './auth'
import payment from './payment'
import product from './product'
import cart from './cart'
import Axios from 'axios'

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

router.beforeEach((to, from, next) => {
  const baseURL = import.meta.env.VITE_APP_URL;
  Axios.get(`${baseURL}/api/admin/auth/check-user`).then(({data})=>{
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!data) {
        next({
          name: 'auth-login',
          query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } else {
      next()
    }
  })
})

export default router