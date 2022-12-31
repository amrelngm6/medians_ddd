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
Vue.component('users_form', () => import('./users_form.vue'));
Vue.component('task_form', () => import('./task_form.vue'));
Vue.component('customers_form', () => import('./customers_form.vue'));

Vue.component('user_modal', () => import('./user_modal.vue'));
Vue.component('lead_modal', () => import('./lead_modal.vue'));
Vue.component('forms', () => import('./forms.vue'));
Vue.component('vue-medialibrary-manager', () => import('./components/Manager.vue'));
Vue.component('vue-medialibrary-field', () => import('./components/Field.vue'));

const VueApp = new Vue(
{
    el: '#app',

    data() {
        return {
            activeModal:'',
            showModal:false,
            showSide:false,
        };
    },

    components: {
    
    },
    beforeCreate: function() {

    },
    mounted() {

    }, 
    methods: {
        viewModal(element, id)
        {
            jQuery('#modal-details').removeClass('hidden')
            this.showModal = !this.showModal;
            this.activeModal = element;

            return this.checkRefById(id);
        },

        viewSide(element)
        {
            jQuery('#modal-sidebar').removeClass('hidden')
            this.showSide = !this.showSide;
            this.activeModal = element;

            return this;
        },

        checkRefById(id)
        {
            var t = this;
            setTimeout(function() {
                console.log(t.$refs[t.activeModal].checkById(id))
            }, 1000);
            return t;
        },


        changeStatus(status, model, id)
        {   
            const params = new URLSearchParams([]);
            params.append('model', model);
            params.append('id', id);
            params.append('status', status);
            this.handleRequest(params, '/api/updateStatus').then(response=> {
                window.location.reload();
                this.$alert(data);
            });

        },

        async handleRequest(params, url = '/api') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                if (response.data)
                    return response.data;
            });
        },
    
        async handleGetRequest(url) {

            // Demo json data
            return await axios.get(url).then(response => 
            {
                if (response.data)
                    return response.data;
            });
        }
    }
});
