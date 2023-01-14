/*
 |--------------------------------------------------------------------------
 | Components
 |--------------------------------------------------------------------------
 | Import JS components.
*/

const axios = require('axios').default;

import Vue from 'vue';
import VueSimpleAlert from "vue-simple-alert";

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

window.Vue = require('vue');

Vue.use(VueSimpleAlert);


Vue.component('date_picker', () => DatePicker);

Vue.component('calendar_products', () => import('./components/calendar-products-list.vue'));
Vue.component('calendar_products_selected', () => import('./components/calendar-products-selected.vue'));
Vue.component('calendar_active_item', () => import('./components/calendar-active-item.vue'));
Vue.component('calendar_modal', () => import('./components/calendar-booking-modal.vue'));
Vue.component('calendar_component', () => import('./calendar-component.vue'));

Vue.component('login-dashboard', () => import('./login-dashboard.vue'));
Vue.component('side-menu', () => import('./side-menu.vue'));
Vue.component('side_cart', () => import('./side_cart.vue'));
Vue.component('customers_form', () => import('./customers_form.vue'));
Vue.component('users_form', () => import('./users_form.vue'));


Vue.component('user_modal', () => import('./user_modal.vue'));
Vue.component('forms', () => import('./forms.vue'));
Vue.component('vue-medialibrary-manager', () => import('./components/Manager.vue'));
Vue.component('vue-medialibrary-field', () => import('./components/Field.vue'));

const VueApp = new Vue(
{
    el: '#app',

    data() {
        return {
            __langs:{},
            date: '',
            activeModal:'',
            showModal:false,
            showSide:false,
            showTab:true,
            activeTab:'step1',
        };
    },

    components: {
        DatePicker
    },
    beforeCreate: function() {

    },
    mounted() {

    }, 
    methods: {
        /**
         * Switch between tabs
         */
        setTab(tab)
        {
            this.activeTab = null; 
            this.showTab = false;  
            this.activeTab = tab; 
            var t = this;
            setTimeout(function(){
               t.showTab = true; 
           }, 100)
        } ,
        openPageByDate(url, event)
        {

            let start = url.includes('?') ? '&' : '?';
            url += start + 'start=' + event[0].getFullYear() +'-'+(event[0].getMonth() + 1) +'-'+ event[0].getDate();    
            url += '&end=' + event[1].getFullYear() +'-'+(event[1].getMonth() + 1) +'-'+ event[1].getDate();    

            let [path, params] = url.split("?");
            let result = path + '?' + new URLSearchParams(Object.fromEntries(new URLSearchParams(params))).toString()

            window.location.href = result;
        },
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
            }, 500);
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

        showSidebar()
        {
            var t = ;
            this.showSide = !this.showSide;
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
        },

        setLangs(langs)
        {
            this.__langs = langs;
        },
        __(i)
        {
            return this.__langs[i];
        }
    }
});
