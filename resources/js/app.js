require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
//for SSR:
import Notifications from 'vue-notification/dist/ssr.js'
import velocity from 'velocity-animate'
import Unicon from 'vue-unicons'
import { uniCheckCircle, uniTimesCircle } from 'vue-unicons/src/icons'
import vSelect from 'vue-select'
import VueTheMask from 'vue-the-mask'


// Components
Vue.component('multiselect', require('vue-multiselect'));
Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(Notifications, { velocity })
Unicon.add([uniCheckCircle, uniTimesCircle])
Vue.use(Unicon)
Vue.component('v-select', vSelect)
Vue.use(VueTheMask)

// CSS
import '../css/vue_notification.scss'
import 'vue-select/dist/vue-select.css';

// Vue instance
const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
