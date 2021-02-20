import { GET_SHOW_ORDER, SET_SHOW_ORDER } from "@/store/mutationsTypes/Order";

export default {
    state: {
        showOrder: false,
        order: {}
    },
    mutations: {
        [SET_SHOW_ORDER]: (state, showOrder) => {
            state.showOrder = showOrder
        }
    },
    getters: {
        [GET_SHOW_ORDER]: (state) => {
            return state.showOrder
        }
    },
    actions: {
        [SET_SHOW_ORDER]: ({ commit }, showOrder) => {
            commit(SET_SHOW_ORDER, showOrder)
        }
    }
};
