(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{42:function(t,e,r){"use strict";var n=r(27),i=r.n(n)()((function(t){return t[1]}));i.push([t.i,"\nbody .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr .fc-toolbar-chunk > div \r\n{\r\n    display: flex;\r\n    gap: 10px;\r\n    font-size: 75%;\n}\nbody .fc .fc-timegrid-col.fc-day-today\r\n{\r\n    background: transparent;\n}\nbody a.fc-event.completed \r\n{\r\n    opacity: .6;\n}\r\n",""]),e.a=i},62:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"container calendar"},[t.showPopup&&t.activeItem?e("div",{staticClass:"fixed top-0 left-0 w-full h-full",staticStyle:{"z-index":"9"}},[e("div",{staticClass:"fixed h-full w-full top-0 left-0 bg-gray-800",staticStyle:{opacity:".6"},on:{click:t.hidePopup}}),t._v(" "),t.showConfirm?e("div",{staticClass:"top-20 relative mx-auto w-full bg-white p-6 rounded-lg",staticStyle:{"max-width":"600px","z-index":"99"}},[e("div",{staticClass:"bg-blue-200 rounded-md py-2 px-4",attrs:{role:"alert"}},[e("strong",[t._v("Confirm!")]),t._v(" Are your sure you want to finish this booking.\n                "),e("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"alert","aria-label":"Close"},on:{click:function(e){t.showConfirm=!1}}})]),t._v(" "),e("div",{staticClass:"my-2 cursor-pointer w-full text-white font-semibold py-2 border-b border-gray-200"},[e("label",{staticClass:"w-32 mx-auto py-2 rounded-lg bg-gradient-primary block text-center cursor-pointer",on:{click:function(e){t.activeItem.status="completed",t.submit("Event.update")}}},[t._v("Confirm")])])]):t._e(),t._v(" "),e("div",{staticClass:"left-0 right-0 fixed mx-auto w-full",staticStyle:{"max-width":"600px","z-index":"99"}},[t.showBooking?e("div",{staticClass:"relative"},[e("calendar_modal",{attrs:{modal:t.activeItem}})],1):t._e(),t._v(" "),t.showActiveBooking?e("div",{staticClass:"relative"},[e("calendar_active_item",{attrs:{games:t.games,modal:t.activeItem}})],1):t._e()])]):t._e(),t._v(" "),e("side_cart",{ref:"side_cart",attrs:{currency:"EGP",cart_items:[]}}),t._v(" "),e("FullCalendar",{ref:"calendar",staticClass:"h-full",attrs:{options:t.calendarOptions}})],1)};n._withStripped=!0;var i=r(37),o=r.n(i),a=(r(36),r(59)),s=r(32),c=r(40),u=r(60);function l(t){return(l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function h(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */h=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},i="function"==typeof Symbol?Symbol:{},o=i.iterator||"@@iterator",a=i.asyncIterator||"@@asyncIterator",s=i.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function u(t,e,r,i){var o=e&&e.prototype instanceof v?e:v,a=Object.create(o.prototype),s=new L(i||[]);return n(a,"_invoke",{value:I(t,r,s)}),a}function d(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var f={};function v(){}function m(){}function p(){}var g={};c(g,o,(function(){return this}));var y=Object.getPrototypeOf,w=y&&y(y(C([])));w&&w!==e&&r.call(w,o)&&(g=w);var b=p.prototype=v.prototype=Object.create(g);function _(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){var i;n(this,"_invoke",{value:function(n,o){function a(){return new e((function(i,a){!function n(i,o,a,s){var c=d(t[i],t,o);if("throw"!==c.type){var u=c.arg,h=u.value;return h&&"object"==l(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){n("next",t,a,s)}),(function(t){n("throw",t,a,s)})):e.resolve(h).then((function(t){u.value=t,a(u)}),(function(t){return n("throw",t,a,s)}))}s(c.arg)}(n,o,i,a)}))}return i=i?i.then(a,a):a()}})}function I(t,e,r){var n="suspendedStart";return function(i,o){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===i)throw o;return P()}for(r.method=i,r.arg=o;;){var a=r.delegate;if(a){var s=k(a,r);if(s){if(s===f)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var c=d(t,e,r);if("normal"===c.type){if(n=r.done?"completed":"suspendedYield",c.arg===f)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n="completed",r.method="throw",r.arg=c.arg)}}}function k(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,k(t,e),"throw"===e.method))return f;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return f}var n=d(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,f;var i=n.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,f):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,f)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function S(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function L(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function C(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:P}}function P(){return{value:void 0,done:!0}}return m.prototype=p,n(b,"constructor",{value:p,configurable:!0}),n(p,"constructor",{value:m,configurable:!0}),m.displayName=c(p,s,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,c(t,s,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},_(x.prototype),c(x.prototype,a,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,i,o){void 0===o&&(o=Promise);var a=new x(u(e,r,n,i),o);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},_(b),c(b,s,"Generator"),c(b,o,(function(){return this})),c(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=C,L.prototype={constructor:L,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(S),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var i=this.tryEntries.length-1;i>=0;--i){var o=this.tryEntries[i],a=o.completion;if("root"===o.tryLoc)return n("end");if(o.tryLoc<=this.prev){var s=r.call(o,"catchLoc"),c=r.call(o,"finallyLoc");if(s&&c){if(this.prev<o.catchLoc)return n(o.catchLoc,!0);if(this.prev<o.finallyLoc)return n(o.finallyLoc)}else if(s){if(this.prev<o.catchLoc)return n(o.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return n(o.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var i=this.tryEntries[n];if(i.tryLoc<=this.prev&&r.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var o=i;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var a=o?o.completion:{};return a.type=t,a.arg=e,o?(this.method="next",this.next=o.finallyLoc,f):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),f},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),S(r),f}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var i=n.arg;S(r)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:C(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),f}},t}function d(t,e,r,n,i,o,a){try{var s=t[o](a),c=s.value}catch(t){return void r(t)}s.done?e(c):Promise.resolve(c).then(n,i)}function f(t){return function(){var e=this,r=arguments;return new Promise((function(n,i){var o=t.apply(e,r);function a(t){d(o,n,i,a,s,"next",t)}function s(t){d(o,n,i,a,s,"throw",t)}a(void 0)}))}}var v=r(11).default,m={components:{moment:o.a,FullCalendar:a.a},data:function(){var t=this;return{showActiveBooking:!1,showBooking:!1,confirm:!1,showNewEvent:!1,showConfirm:!1,showPopup:!1,showUpdate:!1,activeEvent:{start_time:"",end_time:""},activeItem:{},games:[],calendarOptions:{plugins:[u.a,s.f,c.a],initialDate:this.currentDate,scrollTime:this.startTime,locale:this.lang_str,direction:"rtl",buttonText:(this.lang_str,{today:"today",month:"month",week:"week",day:"day",list:"list"}),monthNames:"en"==this.lang_str?null:this.monthsNames,monthNamesShort:"en"==this.lang_str?null:this.monthsNames,dayNames:"en"==this.lang_str?null:this.daysNames,dayNamesShort:"en"==this.lang_str?null:this.daysNames,eventConstraint:"businessHours",initialView:"resourceTimeGridDay",schedulerLicenseKey:"0352628070-fcs-1640670544",titleFormat:{year:"numeric",month:"short",day:"numeric"},headerToolbar:this.headerViewsProvidersMethod(),resources:function(t,e){v.get("/api/calendar").then((function(t){e(t.data.data)}))},events:"/api/calendar_events",businessHours:!1,aspectRatio:2.2,nowIndicator:!0,slotDuration:"00:10:00",selectable:!0,selectMirror:!0,eventMaxStack:3,editable:!0,droppable:!0,weekends:!0,navLinks:!0,navLinkDayClick:!1,allDaySlot:!1,eventClick:function(e){t.activeEvent=e,t.setActiveItem(e.event.extendedProps).showPopup=!0},select:function(e){t.activeItem={},t.setNewItem(e).showPopup=!0},eventReceive:function(t){},eventContent:function(e,r){var n=e.event,i='<span class="w-full flex gsp-4 gsp">',o=e.event.extendedProps&&e.event.extendedProps.game?e.event.extendedProps.game:{picture:""},a=t.dateTime(n.end)+" - "+t.dateTime(n.start);return i+='<img src="'+(o?o.picture:"")+'" class="rounded-full w-8 h-8" />',i+="<span class='font-xxs font-bold text-left w-full'>"+n.title+" <br />"+a+"</span>",{html:i+="</span>"}},drop:function(t){console.log(t)},eventDrop:function(t){},eventResize:function(t){console.log(t)},eventMouseEnter:function(t,e,r){console.log("hover")},eventCreated:function(t){console.log(t)},eventClassNames:function(t){return["background-event-element "]}}}},props:{sidebarLang:Object,buttonsText:Object,monthsNames:Array,daysNames:Array,daysOfWeek:Array,availableDays:Array,title:String,lang_str:String,startTime:String,endTime:String},mounted:function(){},methods:{addToCart:function(t){var e={};t&&(e.id=t.id,e.device=t.device,e.price=t.price,e.duration_time=t.duration_time,e.duration_hours=t.duration_hours,e.subtotal=t.subtotal,e.game=t.game),this.$refs.side_cart.showCart=!0,this.$refs.side_cart.addToCart(e)},addTime:function(t){var e=new Date(t),r=new Date(e.getTime()+36e5);return(r.getHours()>9?r.getHours():"0"+r.getHours())+":"+(r.getMinutes()>9?r.getMinutes():"0"+r.getMinutes())},dateTime:function(t){var e=new Date(t);return(e.getHours()>9?e.getHours():"0"+e.getHours())+":"+(e.getMinutes()>9?e.getMinutes():"0"+e.getMinutes())},dateText:function(t){var e=new Date(t);return e.getFullYear()+"-"+(e.getMonth()+1)+"-"+(e.getDate()>9?e.getDate():"0"+e.getDate())},reloadEvents:function(){this.hidePopup(),this.$refs.calendar.getApi().refetchEvents()},headerViewsProvidersMethod:function(){return{left:this.title,right:"this.headerViewsProviders",center:"prev,today,title,next"}},setNewItem:function(t){return this.showActiveBooking=!0,this.games=t.resource.extendedProps.games,this.activeItem.device_id=t.resource.id,this.activeItem.start=this.dateTime(t.start),this.activeItem.end=this.dateTime(t.end),this.activeItem.startStr=t.startStr,this.activeItem.start_time=this.dateTime(t.startStr),this.activeItem.end_time=this.addTime(t.start),this.activeItem.date=this.dateText(t.startStr),this.activeItem.booking_type="single",this.showNewEvent=!0,this},setActiveItem:function(t){return"active"==t.status?this.showActiveBooking=!0:this.showBooking=!0,this.games=this.activeEvent.event.extendedProps.games,this.activeItem.id=this.activeEvent.event.id,this.activeItem.startStr=this.activeEvent.event.startStr,this.activeItem.start=this.dateTime(this.activeEvent.event.start),this.activeItem.end=this.dateTime(this.activeEvent.event.end),this.activeItem.end_time=t.end_time,this.activeItem.start_time=t.start_time,this.activeItem.break_time=t.break_time,this.activeItem.status=t.status,this.activeItem.device=t.device,this.activeItem.game=t.game,this.activeItem.game_id=t.game_id,this.activeItem.booking_type=t.booking_type,this.activeItem.duration=t.duration,this.activeItem.duration_minutes=t.duration_minutes,this.activeItem.duration_hours=t.duration_hours,this.activeItem.duration_time=t.duration_time,this.activeItem.products=t.products,this.activeItem.currency=t.currency,this.activeItem.payment_method=t.payment_method,this.activeItem.subtotal=this.subtotal(),this.showNewEvent=!0,this},subtotal:function(){var t="single"==this.activeItem.booking_type?this.activeItem.device.price.single_price:this.activeItem.device.price.multi_price;return(Number(t)*Number(this.activeItem.duration_hours)).toFixed(2)},hidePopup:function(){this.showPopup=!1,this.showUpdate=!1,this.showConfirm=!1,this.showNewEvent=!1,this.showBooking=!1,this.showActiveBooking=!1,this.$refs.side_cart.showCart=!1},storeInfo:function(t){this.submit("Event.create")},updateInfo:function(t){return this.showPopup=!1,this.showUpdate=!0,this.showPopup=!0,this},submit:function(t){var e=this,r=this.activeItem.id?"update":"create",n=new URLSearchParams([]);n.append("type",t),n.append("params[event]",JSON.stringify(this.activeItem)),this.handleRequest(n,"/api/"+r).then((function(t){e.reloadEvents(),e.hidePopup()}))},handleRequest:function(t){var e=arguments;return f(h().mark((function r(){var n;return h().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return n=e.length>1&&void 0!==e[1]?e[1]:"/",r.next=3,v.post(n,t.toString()).then((function(t){return 1==t.data.status?t.data.result:t.data}));case 3:return r.abrupt("return",r.sent);case 4:case"end":return r.stop()}}),r)})))()}}},p=r(26),g=r.n(p),y=r(42),w={insert:"head",singleton:!1},b=(g()(y.a,w),y.a.locals,r(25)),_=Object(b.a)(m,n,[],!1,null,null,null);e.default=_.exports}}]);