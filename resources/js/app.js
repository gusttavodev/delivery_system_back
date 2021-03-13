require('./bootstrap');

import Vue from 'vue';

import store from './store';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
//for SSR:
import Notifications from 'vue-notification/dist/ssr.js'
import velocity from 'velocity-animate'
import Unicon from 'vue-unicons'
import { uniCheckCircle, uniTimesCircle, uniShoppingCart } from 'vue-unicons/src/icons'
import vSelect from 'vue-select'
import VueTheMask from 'vue-the-mask'
import VueNumberInput from '@chenfengyuan/vue-number-input';
import Verte from 'verte';


// Components
Vue.component('verte', Verte);
Vue.component('multiselect', require('vue-multiselect'));
Vue.component('vue-number-input', VueNumberInput);
Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(Notifications, { velocity })
Unicon.add([uniCheckCircle, uniTimesCircle, uniShoppingCart])
Vue.use(Unicon)
Vue.component('v-select', vSelect)
Vue.use(VueTheMask)

// CSS
import '../css/vue_notification.scss'
import 'vue-select/dist/vue-select.css';
import 'verte/dist/verte.css';

// Vue instance
const app = document.getElementById('app');

//Utils
import '../utils/currency'

new Vue({
    store,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
