const state = () => ({
	cart: {items: []},
})

const getters = {
	cartItems: (state) => state.cart.items,
}

const actions = {
	SAVE_CART_ITEM ({ commit }, product = {}) {
		commit('saveCartItem', product)
	},
	REMOVE_PARAM({ commit }, product = {}) {
		commit("removeCartItem", product);
	},
	ADD_QUANTITY({ commit }, product = {}) {
		commit("addQuantity", product);
	},
	DEDUCT_QUANTITY({ commit }, product = {}) {
		commit("deductQuantity", product);
	},
}

const mutations = {
	deductQuantity (state, product) {
		if(! product) return;
		let index = state.cart.items.findIndex(function(item){
			return item && item.id == product.id
		})
		if(index !== -1){
			product.buy_quantity = product.buy_quantity - 1
			if(product.buy_quantity < 1) product.buy_quantity = 0;
			product.buy_price_total = product.buy_quantity * product.price
			state.cart.items.splice(index, 1, product)
		}
	},
	addQuantity (state, product) {
		if(! product) return;
		let index = state.cart.items.findIndex(function(item){
			return item && item.id == product.id
		})
		if(index !== -1){
			product.buy_quantity = product.buy_quantity + 1
			product.buy_price_total = product.buy_quantity * product.price
			state.cart.items.splice(index, 1, product)
		}
	},
	saveCartItem (state, product) {
		if(! product) return;
		let index = state.cart.items.findIndex(function(item){
			return item && item.id == product.id
		})
		if(index === -1){
			product.buy_quantity = 1
			product.buy_price_total = product.buy_quantity * product.price
			state.cart.items.push(product)
		}else{
			product.buy_quantity = product.buy_quantity + 1
			product.buy_price_total = product.buy_quantity * product.price
			state.cart.items.splice(index, 1, product)
		}
	},
	removeCartItem(state, product){
		let index = state.cart.items.findIndex(function(item){
		  if(item && item.id == product.id){
			return true;
		  }
		})
		if(index !== -1){
		  delete state.cart.items[index];
		}
	},
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}
