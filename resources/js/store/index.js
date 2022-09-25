import { createStore, createLogger } from 'vuex'
import ui from './modules/ui'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
    modules: {
        ui,
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
})