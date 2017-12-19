
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// global event bus
window.events = new Vue();

// Setup autharization
Vue.prototype.signedIn = window.App.signedIn;
Vue.prototype.isAdmin = window.App.isAdmin;

Vue.component('orders', require('./components/Orders.vue'));
Vue.component('furniture', require('./components/Furniture.vue'));

const app = new Vue({
    el: '#app'
});
