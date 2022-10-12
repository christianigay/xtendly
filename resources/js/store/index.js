import { createStore, createLogger } from 'vuex'
import ui from './modules/ui'
import cart from './modules/cart'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
    modules: {
        ui,
        cart,
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
})