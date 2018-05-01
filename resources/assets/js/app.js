require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store';
import MainApp from './components/MainApp.vue';
import { initialize } from './helpers/general';
import VueGoodTable from "vue-good-table";
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueGoodTable)

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router);

new Vue({
    router,
    store,
    render: h => h(MainApp)
}).$mount('#app')
