<template>
    <div class="container calendar">

        <div class="fixed top-0 left-0 w-full h-full" style="z-index: 9;" v-if="showPopup && activeItem">

            <!-- Modal bg overlay -->
            <div @click="hidePopup" class="fixed h-full w-full top-0 left-0 bg-gray-800" style="opacity: .6"></div>

            <!-- Confirm overlay -->
            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px; z-index: 99;" v-if="showConfirm">
                
                <div class="bg-blue-200 rounded-md py-2 px-4" role="alert">
                    <strong>Confirm!</strong> Are your sure you want to finish this booking.
                    <button @click="showConfirm = false" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div  class="my-2 cursor-pointer w-full text-white  font-semibold py-2 border-b border-gray-200">
                    <label @click="activeItem.status = 'completed'; submit('Event.update')" class="w-32 mx-auto py-2 rounded-lg bg-gradient-primary block text-center cursor-pointer">Confirm</label>
                </div>

            </div>

            
            <div class="left-0 right-0 fixed mx-auto w-full " style="max-width: 600px; z-index: 99;" >
                <div v-if="showBooking " class="relative">
                    <calendar_modal :modal="activeItem"></calendar_modal>
                </div>
                <div v-if="showActiveBooking"  class="relative">
                    <calendar_active_item :games="games" :modal="activeItem"></calendar_active_item>
                </div>
            </div>
        </div>

        <side_cart ref="side_cart" currency="EGP" :cart_items="[]"></side_cart>

        <FullCalendar :options="calendarOptions" ref="calendar" class="h-full"></FullCalendar>

    </div>
</template>

<script>
const axios = require('axios').default;
import VueMoment from 'vue-moment'
 

import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin, {Draggable} from '@fullcalendar/interaction'
import resourceTimeGridDay from '@fullcalendar/resource-timegrid';


    export default {
        components: {
            moment:VueMoment,
            FullCalendar // make the <FullCalendar> tag available
        },
        data() {

            var t = this;

            return {
                
                showActiveBooking: false,
                showBooking: false,
                confirm: false,
                showNewEvent: false,
                showConfirm: false,
                showPopup: false,
                
                showUpdate: false,

                activeEvent : {start_time:'', end_time:''},

                activeItem: {},

                games: [],

                calendarOptions: {
                    plugins: [resourceTimeGridDay, dayGridPlugin, interactionPlugin],
                    initialDate: this.currentDate,
                    scrollTime: this.startTime,
                    locale: this.lang_str,
                    direction: 'rtl',
                    buttonText: (this.lang_str == 'en') ? {
                        today:    'today',
                        month:    'month',
                        week:     'week',
                        day:      'day',
                        list:     'list'
                    } : {
                        today:    'today',
                        month:    'month',
                        week:     'week',
                        day:      'day',
                        list:     'list'
                    },
                    monthNames: (this.lang_str == 'en') ? null : this.monthsNames,
                    monthNamesShort: (this.lang_str == 'en') ? null : this.monthsNames,
                    dayNames: (this.lang_str == 'en') ? null : this.daysNames,
                    dayNamesShort: (this.lang_str == 'en') ? null : this.daysNames,
                    eventConstraint: "businessHours",

                    initialView: 'resourceTimeGridDay',
                    schedulerLicenseKey: '0352628070-fcs-1640670544',
                    titleFormat: {year: 'numeric', month: 'short', day: 'numeric'},
                    headerToolbar: this.headerViewsProvidersMethod(),
                    
                    resources: function (fetchInfo, successCallback) 
                    {
                        let requestPath = '/api/calendar';
                        axios.get(requestPath).then(res => {
                            successCallback(res.data.data)
                        });
                    },
                    events: '/api/calendar_events',
                    businessHours: false,
                    aspectRatio: 2.2,
                    nowIndicator: true,
                    slotDuration: '00:10:00',
                    selectable: true,
                    selectMirror: true,
                    eventMaxStack: 3,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar
                    weekends: true,
                    navLinks: true,
                    navLinkDayClick: false,
                    allDaySlot:false,

                    // selectOverlap: function(event) {
                    //     return event.rendering === 'background';
                    // },
                    eventClick(event) {
                        t.activeEvent = event;
                        t.setActiveItem(event.event.extendedProps).showPopup = true;
                        // t.submit('check_event', );
                    },

                    select(info) {
                        t.activeItem = {};
                        t.setNewItem(info).showPopup = true;
                    },

                    eventReceive(info) {
                    },
    
                    eventContent: function(arg, item) {
                        var event = arg.event;
                        var customHtml = '<span class="w-full flex gsp-4 gsp">';
                        let game = arg.event.extendedProps && arg.event.extendedProps.game ? arg.event.extendedProps.game : {picture:''};
                        var time = t.dateTime(event.end) + " - "+ t.dateTime(event.start);
                        customHtml += '<img src="'+(game ? game.picture : '')+'" class="rounded-full w-8 h-8" />';
                        
                        customHtml += "<span class='font-xxs font-bold text-left w-full'>" + event.title + " <br />" + time + "</span>";

                        customHtml += '</span>';
                                      

                        return { html: customHtml }

                    },

                    drop(info) {
                        console.log(info);
                    },

                    eventDrop(event) {

                    },
                    eventResize(event) {
                        console.log(event)
                    },
                    eventMouseEnter(event, jsEvent, view) {
                        console.log('hover');
                    },
                    eventCreated(event) {
                        console.log(event);
                    },
                    eventClassNames: function (arg) {
                        return [ 'background-event-element ' ];
                    }
                },
            };
        },
        props: {
            sidebarLang: Object,
            buttonsText: Object,
            monthsNames: Array,
            daysNames: Array,
            daysOfWeek: Array,
            availableDays: Array,
            title: String,
            lang_str: String,
            startTime: String,
            endTime: String,
        },
        
        mounted() {

        },
        methods: {
            addToCart(activeItem)
            {
                let item = {};
                if (activeItem)
                {
                    item.id = activeItem.id;
                    item.device = activeItem.device;
                    item.price = activeItem.price;
                    item.duration_time = activeItem.duration_time;
                    item.duration_hours = activeItem.duration_hours;
                    item.subtotal = activeItem.subtotal;
                    item.game = activeItem.game;
                }
                this.$refs.side_cart.showCart = true
                this.$refs.side_cart.addToCart(item);
            },
            addTime(time)
            {
                var now = new Date(time);
                var d = new Date(now.getTime() + (1 * 60 * 60 * 1000));
                var datestring = (d.getHours() > 9 ? d.getHours() : '0'+d.getHours()) + ":" + (d.getMinutes() > 9 ? d.getMinutes() : '0'+d.getMinutes());

                return datestring;
            },
            dateTime(date)
            {
                // var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear() + " ";
                var d = new Date(date);
                var datestring = (d.getHours() > 9 ? d.getHours() : '0'+d.getHours()) + ":" + (d.getMinutes() > 9 ? d.getMinutes() : '0'+d.getMinutes());

                return datestring;
            },
            dateText(date)
            {
                var d = new Date(date);
                var datestring = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + (d.getDate() > 9 ? d.getDate() : '0'+d.getDate());
                return datestring;
            },
            reloadEvents() 
            {
                this.hidePopup()
                this.$refs.calendar.getApi().refetchEvents();
            },

            headerViewsProvidersMethod() 
            {
                return {
                    left: this.title,
                    right: 'this.headerViewsProviders',
                    center: 'prev,today,title,next',
                };
            },

            /** 
             * Set active item
             * '
             */
            setNewItem(newEvenet)
            {
                this.showActiveBooking = true
                this.games = newEvenet.resource.extendedProps.games
                this.activeItem.device_id = newEvenet.resource.id
                this.activeItem.start = this.dateTime(newEvenet.start)
                this.activeItem.end = this.dateTime(newEvenet.end)
                this.activeItem.startStr = newEvenet.startStr
                this.activeItem.start_time = this.dateTime(newEvenet.startStr)
                this.activeItem.end_time = this.addTime(newEvenet.start)
                this.activeItem.date = this.dateText(newEvenet.startStr)
                this.activeItem.booking_type = 'single'
                this.showNewEvent = true
                return this;
            },

            /** 
             * Set active item
             * '
             */
            setActiveItem(props)
            {
                if (props.status == 'active')
                {
                    this.showActiveBooking = true
                } else {
                    this.showBooking = true

                }

                this.games = this.activeEvent.event.extendedProps.games
                this.activeItem.id = this.activeEvent.event.id;
                this.activeItem.startStr = this.activeEvent.event.startStr
                this.activeItem.start = this.dateTime(this.activeEvent.event.start)
                this.activeItem.end = this.dateTime(this.activeEvent.event.end)
                this.activeItem.end_time = props.end_time;
                this.activeItem.start_time = props.start_time;
                this.activeItem.break_time = props.break_time;
                this.activeItem.status = props.status;
                this.activeItem.device = props.device;
                this.activeItem.game = props.game;
                this.activeItem.game_id = props.game_id;
                this.activeItem.booking_type = props.booking_type;
                this.activeItem.duration = props.duration;
                this.activeItem.duration_minutes = props.duration_minutes;
                this.activeItem.duration_hours = props.duration_hours;
                this.activeItem.duration_time = props.duration_time;
                this.activeItem.products = props.products;
                this.activeItem.currency = props.currency;
                this.activeItem.payment_method = props.payment_method;
                this.activeItem.subtotal = this.subtotal();
                this.showNewEvent = true

                return this;
            },
            subtotal()
            {
                let price = (this.activeItem.booking_type == 'single') ? this.activeItem.device.price.single_price : this.activeItem.device.price.multi_price;

                return (Number(price) * Number(this.activeItem.duration_hours)).toFixed(2) ;
            },
            hidePopup()
            {
                this.showPopup = false;
                this.showUpdate = false;
                this.showConfirm = false;
                this.showNewEvent = false;
                this.showBooking = false;
                this.showActiveBooking = false;
                this.$refs.side_cart.showCart = false

            },
            /**
             * Update event data
             */
            storeInfo(activeItem)
            {
                this.submit('Event.create')
            } ,
            /**
             * Update event data
             */
            updateInfo(activeItem)
            {
                this.showPopup = false; 
                this.showUpdate = true;
                this.showPopup = true

                return this;
            } ,

            submit(type) {

                let request_type = this.activeItem.id ? 'update' : 'create';

                const params = new URLSearchParams([]);
                params.append('type', type);
                params.append('params[event]', JSON.stringify(this.activeItem));
                this.handleRequest(params, '/api/'+request_type).then(data => { 
                    this.reloadEvents();
                    this.hidePopup();
                });
            },
            async handleRequest(params, url='/') {

                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {
                    if (response.data.status == true)
                        return response.data.result;
                    else 
                        return response.data;
                });
            }


        }
    }
</script>
<style lang='css'>
body .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr .fc-toolbar-chunk > div 
{
    display: flex;
    gap: 10px;
    font-size: 75%;
}
body .fc .fc-timegrid-col.fc-day-today
{
    background: transparent;
}
body a.fc-event.completed 
{
    opacity: .6;
}
</style>