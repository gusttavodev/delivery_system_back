export default {
    namespaced: true,
    state: () => ({
        use: {}
    }),
    mutations: {
        ADD_Item(state, id) {
            state.StoreCart.push(id);
        },

        REMOVE_Item(state, index) {
            state.StoreCart.splice(index, 1);
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
