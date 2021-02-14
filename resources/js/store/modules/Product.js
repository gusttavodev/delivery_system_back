import { SET_PRODUCT, GET_PRODUCT, DELETE_PRODUCT, HAS_PRODUCT } from "@/store/mutationsTypes/Product";

export default {
    state: {
        product: {}
    },
    mutations: {
        [SET_PRODUCT]: (state, product) => {
            state.product = product;
        }
    },
    getters: {
        [GET_PRODUCT]: (state) => {
            return state.product
        },
        [HAS_PRODUCT]: (state) => {
            return Object.keys( state.product).length === 0 ? false : true
        }
    },
    actions: {
        [SET_PRODUCT]: ({ commit }, product) => {
            commit(SET_PRODUCT, product)
        },
        [DELETE_PRODUCT]: ({ commit }) => {
            commit(SET_PRODUCT, {})
        }
    }
};
