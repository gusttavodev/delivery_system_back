import { GET_CART, ADD_ITEM, REMOVE_ITEM, CART_COUNT } from "@/store/mutationsTypes/StoreCart";

export default {
    state: {
        storeCart: []
    },
    mutations: {
        [ADD_ITEM]: (state, product) => {
            const foundIndex = state.storeCart.findIndex(data => data.id === product.id);
            state.storeCart.push(product);
        },
        [REMOVE_ITEM]: (state, product) => {
            const foundIndex = state.storeCart.findIndex(data => data.id === product.id);
            state.storeCart.splice(foundIndex, 1);
        }
    },
    getters: {
        [GET_CART]: (state) => {
            return state.storeCart
        },
        [CART_COUNT]: (state) => {
            return state.storeCart.length
        }
    },
    actions: {
        [ADD_ITEM]: ({ commit }, product) => {
            commit(ADD_ITEM, product)
        },
        [REMOVE_ITEM]: ({ commit }, product) => {
            commit(REMOVE_ITEM, {product})
        }
    }
};
