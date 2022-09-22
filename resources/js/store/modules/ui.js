const state = () => ({
    drawer: true,
})

const getters = {
    drawer: (state) => state.drawer,
}

const actions = {
    MODIFY_DRAWER ({ commit }) {
        commit('updateDrawer')
    },
}

const mutations = {
    updateDrawer (state) {
        state.drawer = !state.drawer
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}
