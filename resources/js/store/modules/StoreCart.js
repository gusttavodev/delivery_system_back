export default {
    namespaced: true,
    state: () => ({
        storeCart: {}
    }),
    mutations: {
        ADD_Item(state, id) {
            state.storeCart.push(id);
        },

        REMOVE_Item(state, index) {
            state.storeCart.splice(index, 1);
        }
    },
    actions: {
        addItem(context, id) {
            context.commit("ADD_Item", id);
        },

        removeItem(context, index) {
            context.commit("REMOVE_Item", index);
        }
    }
};
