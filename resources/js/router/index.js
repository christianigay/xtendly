import { createRouter,createWebHistory} from 'vue-router'
import home from './home'
import auth from './auth'

const routes = [
    ...home,
    ...auth
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router