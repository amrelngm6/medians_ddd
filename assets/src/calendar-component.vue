<template>
    <div class="container calendar">

        <div class="fixed top-0 left-0 w-full h-full" style="z-index: 9;" v-if="showPopup && activeItem">
            <div @click="showPopup = false; showUpdate = false" class="fixed h-full w-full top-0 left-0 bg-gray-800" style="opacity: .6"></div>
            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px;" v-if="activeItem.status == 'completed'">

                <div class="bg-yellow-200 rounded-md py-2 px-4" role="alert">
                    <strong>Warning!</strong> This order is completed.
                    <button @click="showPopup = false; showUpdate = false" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                    <label class="w-full">Game</label>

                    <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                        <div class="overflow-x-auto" >
                            <label class="inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
                                <img class="mx-auto w-6 h-6 rounded-full my-2" :src="activeItem.game ? activeItem.game.picture : ''">
                                <span v-text="activeItem.game ? activeItem.game.name : ''"></span> 
                            </label>
                        </div>
                    </div>
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Start</label>
                    <input disabled class="w-full" type="time" v-model="activeItem.start_time">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">End</label>
                    <input disabled class="w-full" type="time" v-model="activeItem.end_time">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Date</label>
                    <input disabled class="w-full" type="text" :value="dateText(activeItem.startStr)">
                </div>
                <div class="w-full flex gap-6 my-2 text-gray-600">
                    <label  class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
                        <span v-text="activeItem.booking_type"></span>
                    </label>
                </div>
            </div>
            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg" style="max-width: 600px;" v-if="activeItem.status != 'completed'">
                <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                    <label class="w-full">Game</label>

                    <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                        <div class="overflow-x-auto" :style='{"min-width": games.length*35+"%"}' >
                            <label v-for="game in games"  
                                @click="activeItem.game_id = game.id;  showPopup = false; showPopup = true; updateInfo(activeItem)"
                                :for="'single-'+game.id"  
                                class="inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold" 
                                :class="activeItem.game_id == game.id ? 'bg-purple-600 text-white' : 'border-purple-600 text-purple-800'" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="game.picture">
                                    <span v-text="game.name"></span> 
                                    <input @change="updateInfo(activeItem)"  :id="'id-'+game.id" v-model="activeItem.game_id" :value="game.id" type="radio" name="game_id" class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- <input name="game_id" v-model="activeItem.game_id" v-text="game.name" :value="game.id"></option> -->

<!--                     <select class="w-full" type="time" v-model="activeItem.game_id">
                        <option v-for="game in games" v-text="game.name" :value="game.id"></option>
                    </select> -->

                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">Start</label>
                    <input @change="updateInfo(activeItem)" class="w-full" type="time" v-model="activeItem.start_time">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full">End</label>
                    <input @change="updateInfo(activeItem)"  class="w-full" type="time" v-model="activeItem.end_time">
                </div>
                <div class="w-full flex gap-6 my-2 text-gray-600">
                    <label @click="activeItem.booking_type = 'single';  updateInfo(activeItem)" for="single"  class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold" :class="activeItem.booking_type == 'single' ? 'bg-purple-600 text-white' : ''" >Single <input id="signle" v-model="activeItem.booking_type" value="single" type="radio" name="booking_type" class="hidden"></label>
                    <label @click="activeItem.booking_type = 'multi'; updateInfo(activeItem)"  for="multi" class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold" :class="activeItem.booking_type == 'multi' ? 'bg-purple-600 text-white' : ''"  >Multi <input id="multi"  v-model="activeItem.booking_type" value="multi" type="radio" name="booking_type"  class="hidden"></label>
                </div>
                <div v-if="!activeItem.id" class="w-full text-white  font-semibold py-2 border-b border-gray-200">
                    <label @click="storeInfo(activeItem)" class="px-4 py-2 rounded-lg bg-gradient-primary block">Start Playing</label>
                </div>
                <div v-if="activeItem.id && showUpdate" class="w-full text-white  font-semibold py-2 border-b border-gray-200">
                    <label @click="submit('Event.update')" class="px-4 py-2 rounded-lg bg-gradient-primary block">Update</label>
                </div>
            </div>
        </div>

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
                    aspectRatio: 1.2,
                    nowIndicator: true,
                    slotDuration: '00:15:00',
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
                        return [ 'background-event-element bg-gradient-purple' ];
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
                this.$refs.calendar.getApi().refetchEvents();
            },

            headerViewsProvidersMethod() 
            {
                return {
                    left: this.title,
                    right: this.headerViewsProviders,
                    center: 'prev,today,title,next',
                };
            },

            /** 
             * Set active item
             * '
             */
            setNewItem(newEvenet)
            {
                this.games = newEvenet.resource.extendedProps.games
                this.activeItem.device_id = newEvenet.resource.id
                this.activeItem.start = this.dateTime(newEvenet.start)
                this.activeItem.end = this.dateTime(newEvenet.end)
                this.activeItem.startStr = newEvenet.startStr
                this.activeItem.start_time = this.dateTime(newEvenet.startStr)
                this.activeItem.end_time = this.dateTime(newEvenet.endStr)
                this.activeItem.date = this.dateText(newEvenet.startStr)
                this.activeItem.booking_type = 'single'

                return this;
            },

            /** 
             * Set active item
             * '
             */
            setActiveItem(props)
            {
                console.log(this.activeEvent)
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

                return this;
            },
            hidePopup()
            {
                this.showPopup = false;
                this.showUpdate = false;
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