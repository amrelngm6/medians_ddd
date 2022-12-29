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
Vue.component('side-menu', () => import('./side-menu.vue'));
Vue.component('property_form', () => import('./property_form.vue'));
Vue.component('leads_form', () => import('./leads_form.vue'));
Vue.component('organization_form', () => import('./organization_form.vue'));
Vue.component('contacts_form', () => import('./contacts_form.vue'));
Vue.component('forms', () => import('./forms.vue'));
Vue.component('vue-medialibrary-manager', () => import('./components/Manager.vue'));
Vue.component('vue-medialibrary-field', () => import('./components/Field.vue'));

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
