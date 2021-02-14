import Vue from 'vue';
import Vuex, { Store } from 'vuex';

import Product from '@/store/modules/Product';
import StoreCart from '@/store/modules/StoreCart';

Vue.use(Vuex);

export default new Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        StoreCart,
        Product
    },
});
