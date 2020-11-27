require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import MovieMixin from './mixins/globalMixin'
import Layout from "./pages/Layout";

Vue.mixin(MovieMixin)
Vue.mixin({methods: {route}})
Vue.mixin({mounted() {document.querySelector('body').scrollTo(0, 0)}})
Vue.use(plugin)
Vue.use(require('vue-moment'))

// global component
Vue.component('app-layout', Layout)

const el = document.getElementById('app')

new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./pages/${name}`).default,
        },
    }),
}).$mount(el)
InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#00dcdd',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})

