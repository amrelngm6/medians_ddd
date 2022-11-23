/*
 |--------------------------------------------------------------------------
 | Components
 |--------------------------------------------------------------------------
 | Import JS components.
*/

const axios = require('axios').default;

import Vue from 'vue';
import VueSimpleAlert from "vue-simple-alert";


window.Vue = require('vue');

Vue.use(VueSimpleAlert);

Vue.component('demo', () => import('./demo.vue'));
Vue.component('login-dashboard', () => import('./login-dashboard.vue'));

const VueApp = new Vue(
{
    el: '#app',

    components: {
    
    },
    beforeCreate: function() {

    },
    mounted() {

    }
});
