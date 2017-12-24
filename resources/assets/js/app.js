require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import { store } from './store.js'

Vue.use(Vuex)

// global event bus
window.events = new Vue();

// Setup autharization
Vue.prototype.signedIn = window.App.signedIn;
Vue.prototype.isAdmin = window.App.isAdmin;

Vue.component('orders', require('./components/Orders.vue'));
Vue.component('furniture', require('./components/Furniture.vue'));

const app = new Vue({
    el: '#app',
    store
});
