(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{42:function(t,e,n){"use strict";var r=n(27),i=n.n(r)()((function(t){return t[1]}));i.push([t.i,"\nbody .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr .fc-toolbar-chunk > div \r\n{\r\n    display: flex;\r\n    gap: 10px;\r\n    font-size: 75%;\n}\nbody .fc .fc-timegrid-col.fc-day-today\r\n{\r\n    background: transparent;\n}\nbody a.fc-event.completed \r\n{\r\n    opacity: .6;\n}\r\n",""]),e.a=i},62:function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t._self._c;return e("div",{staticClass:"container calendar"},[t.showPopup&&t.activeItem?e("div",{staticClass:"fixed top-0 left-0 w-full h-full",staticStyle:{"z-index":"9"}},[e("div",{staticClass:"fixed h-full w-full top-0 left-0 bg-gray-800",staticStyle:{opacity:".6"},on:{click:function(e){t.showPopup=!1,t.showUpdate=!1}}}),t._v(" "),"completed"==t.activeItem.status?e("div",{staticClass:"top-20 relative mx-auto w-full bg-white p-6 rounded-lg",staticStyle:{"max-width":"600px"}},[e("div",{staticClass:"bg-yellow-200 rounded-md py-2 px-4",attrs:{role:"alert"}},[e("strong",[t._v("Warning!")]),t._v(" This order is completed.\n                    "),e("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"alert","aria-label":"Close"},on:{click:function(e){t.showPopup=!1,t.showUpdate=!1}}})]),t._v(" "),e("div",{staticClass:"w-full block gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("Game")]),t._v(" "),e("div",{staticClass:"w-full block gap-4 my-2 text-gray-600 overflow-x-auto"},[e("div",{staticClass:"overflow-x-auto"},[e("label",{staticClass:"inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold bg-purple-600 text-white"},[e("img",{staticClass:"mx-auto w-6 h-6 rounded-full my-2",attrs:{src:t.activeItem.game?t.activeItem.game.picture:""}}),t._v(" "),e("span",{domProps:{textContent:t._s(t.activeItem.game?t.activeItem.game.name:"")}})])])])]),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("Start")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.start_time,expression:"activeItem.start_time"}],staticClass:"w-full",attrs:{disabled:"",type:"time"},domProps:{value:t.activeItem.start_time},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"start_time",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("End")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.end_time,expression:"activeItem.end_time"}],staticClass:"w-full",attrs:{disabled:"",type:"time"},domProps:{value:t.activeItem.end_time},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"end_time",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("Date")]),t._v(" "),e("input",{staticClass:"w-full",attrs:{disabled:"",type:"text"},domProps:{value:t.dateText(t.activeItem.startStr)}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-6 my-2 text-gray-600"},[e("label",{staticClass:"cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold bg-purple-600 text-white"},[e("span",{domProps:{textContent:t._s(t.activeItem.booking_type)}})])])]):t._e(),t._v(" "),"completed"!=t.activeItem.status?e("div",{staticClass:"top-20 relative mx-auto w-full bg-white p-6 rounded-lg",staticStyle:{"max-width":"600px"}},[e("div",{staticClass:"w-full block gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("Game")]),t._v(" "),e("div",{staticClass:"w-full block gap-4 my-2 text-gray-600 overflow-x-auto"},[e("div",{staticClass:"overflow-x-auto",style:{"min-width":35*t.games.length+"%"}},t._l(t.games,(function(n){return e("label",{staticClass:"inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold",class:t.activeItem.game_id==n.id?"bg-purple-600 text-white":"border-purple-600 text-purple-800",attrs:{for:"single-"+n.id},on:{click:function(e){t.activeItem.game_id=n.id,t.showPopup=!1,t.showPopup=!0,t.updateInfo(t.activeItem)}}},[e("img",{staticClass:"mx-auto w-6 h-6 rounded-full my-2",attrs:{src:n.picture}}),t._v(" "),e("span",{domProps:{textContent:t._s(n.name)}}),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.game_id,expression:"activeItem.game_id"}],staticClass:"hidden",attrs:{id:"id-"+n.id,type:"radio",name:"game_id"},domProps:{value:n.id,checked:t._q(t.activeItem.game_id,n.id)},on:{change:[function(e){return t.$set(t.activeItem,"game_id",n.id)},function(e){return t.updateInfo(t.activeItem)}]}})])})),0)])]),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("Start")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.start_time,expression:"activeItem.start_time"}],staticClass:"w-full",attrs:{type:"time"},domProps:{value:t.activeItem.start_time},on:{change:function(e){return t.updateInfo(t.activeItem)},input:function(e){e.target.composing||t.$set(t.activeItem,"start_time",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("End")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.end_time,expression:"activeItem.end_time"}],staticClass:"w-full",attrs:{type:"time"},domProps:{value:t.activeItem.end_time},on:{change:function(e){return t.updateInfo(t.activeItem)},input:function(e){e.target.composing||t.$set(t.activeItem,"end_time",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-6 my-2 text-gray-600"},[e("label",{staticClass:"cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold",class:"single"==t.activeItem.booking_type?"bg-purple-600 text-white":"",attrs:{for:"single"},on:{click:function(e){t.activeItem.booking_type="single",t.updateInfo(t.activeItem)}}},[t._v("Single "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.booking_type,expression:"activeItem.booking_type"}],staticClass:"hidden",attrs:{id:"signle",value:"single",type:"radio",name:"booking_type"},domProps:{checked:t._q(t.activeItem.booking_type,"single")},on:{change:function(e){return t.$set(t.activeItem,"booking_type","single")}}})]),t._v(" "),e("label",{staticClass:"cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold",class:"multi"==t.activeItem.booking_type?"bg-purple-600 text-white":"",attrs:{for:"multi"},on:{click:function(e){t.activeItem.booking_type="multi",t.updateInfo(t.activeItem)}}},[t._v("Multi "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.booking_type,expression:"activeItem.booking_type"}],staticClass:"hidden",attrs:{id:"multi",value:"multi",type:"radio",name:"booking_type"},domProps:{checked:t._q(t.activeItem.booking_type,"multi")},on:{change:function(e){return t.$set(t.activeItem,"booking_type","multi")}}})])]),t._v(" "),t.activeItem.id?t._e():e("div",{staticClass:"w-full text-white font-semibold py-2 border-b border-gray-200"},[e("label",{staticClass:"px-4 py-2 rounded-lg bg-gradient-primary block",on:{click:function(e){return t.storeInfo(t.activeItem)}}},[t._v("Start Playing")])]),t._v(" "),t.activeItem.id&&t.showUpdate?e("div",{staticClass:"w-full text-white font-semibold py-2 border-b border-gray-200"},[e("label",{staticClass:"px-4 py-2 rounded-lg bg-gradient-primary block",on:{click:function(e){return t.submit("Event.update")}}},[t._v("Update")])]):t._e()]):t._e()]):t._e(),t._v(" "),e("FullCalendar",{ref:"calendar",staticClass:"h-full",attrs:{options:t.calendarOptions}})],1)};r._withStripped=!0;var i=n(37),a=n.n(i),o=(n(36),n(59)),s=n(32),l=n(40),c=n(60);function u(t){return(u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function d(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */d=function(){return t};var t={},e=Object.prototype,n=e.hasOwnProperty,r=Object.defineProperty||function(t,e,n){t[e]=n.value},i="function"==typeof Symbol?Symbol:{},a=i.iterator||"@@iterator",o=i.asyncIterator||"@@asyncIterator",s=i.toStringTag||"@@toStringTag";function l(t,e,n){return Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,n){return t[e]=n}}function c(t,e,n,i){var a=e&&e.prototype instanceof p?e:p,o=Object.create(a.prototype),s=new S(i||[]);return r(o,"_invoke",{value:I(t,n,s)}),o}function v(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}t.wrap=c;var m={};function p(){}function f(){}function h(){}var g={};l(g,a,(function(){return this}));var y=Object.getPrototypeOf,b=y&&y(y(E([])));b&&b!==e&&n.call(b,a)&&(g=b);var w=h.prototype=p.prototype=Object.create(g);function _(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){var i;r(this,"_invoke",{value:function(r,a){function o(){return new e((function(i,o){!function r(i,a,o,s){var l=v(t[i],t,a);if("throw"!==l.type){var c=l.arg,d=c.value;return d&&"object"==u(d)&&n.call(d,"__await")?e.resolve(d.__await).then((function(t){r("next",t,o,s)}),(function(t){r("throw",t,o,s)})):e.resolve(d).then((function(t){c.value=t,o(c)}),(function(t){return r("throw",t,o,s)}))}s(l.arg)}(r,a,i,o)}))}return i=i?i.then(o,o):o()}})}function I(t,e,n){var r="suspendedStart";return function(i,a){if("executing"===r)throw new Error("Generator is already running");if("completed"===r){if("throw"===i)throw a;return L()}for(n.method=i,n.arg=a;;){var o=n.delegate;if(o){var s=k(o,n);if(s){if(s===m)continue;return s}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if("suspendedStart"===r)throw r="completed",n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r="executing";var l=v(t,e,n);if("normal"===l.type){if(r=n.done?"completed":"suspendedYield",l.arg===m)continue;return{value:l.arg,done:n.done}}"throw"===l.type&&(r="completed",n.method="throw",n.arg=l.arg)}}}function k(t,e){var n=t.iterator[e.method];if(void 0===n){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,k(t,e),"throw"===e.method))return m;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return m}var r=v(n,t.iterator,e.arg);if("throw"===r.type)return e.method="throw",e.arg=r.arg,e.delegate=null,m;var i=r.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,m):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,m)}function C(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function P(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(C,this),this.reset(!0)}function E(t){if(t){var e=t[a];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,i=function e(){for(;++r<t.length;)if(n.call(t,r))return e.value=t[r],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:L}}function L(){return{value:void 0,done:!0}}return f.prototype=h,r(w,"constructor",{value:h,configurable:!0}),r(h,"constructor",{value:f,configurable:!0}),f.displayName=l(h,s,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===f||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,l(t,s,"GeneratorFunction")),t.prototype=Object.create(w),t},t.awrap=function(t){return{__await:t}},_(x.prototype),l(x.prototype,o,(function(){return this})),t.AsyncIterator=x,t.async=function(e,n,r,i,a){void 0===a&&(a=Promise);var o=new x(c(e,n,r,i),a);return t.isGeneratorFunction(n)?o:o.next().then((function(t){return t.done?t.value:o.next()}))},_(w),l(w,s,"Generator"),l(w,a,(function(){return this})),l(w,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),n=[];for(var r in e)n.push(r);return n.reverse(),function t(){for(;n.length;){var r=n.pop();if(r in e)return t.value=r,t.done=!1,t}return t.done=!0,t}},t.values=E,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(P),!t)for(var e in this)"t"===e.charAt(0)&&n.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function r(n,r){return o.type="throw",o.arg=t,e.next=n,r&&(e.method="next",e.arg=void 0),!!r}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],o=a.completion;if("root"===a.tryLoc)return r("end");if(a.tryLoc<=this.prev){var s=n.call(a,"catchLoc"),l=n.call(a,"finallyLoc");if(s&&l){if(this.prev<a.catchLoc)return r(a.catchLoc,!0);if(this.prev<a.finallyLoc)return r(a.finallyLoc)}else if(s){if(this.prev<a.catchLoc)return r(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return r(a.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var i=this.tryEntries[r];if(i.tryLoc<=this.prev&&n.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var a=i;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var o=a?a.completion:{};return o.type=t,o.arg=e,a?(this.method="next",this.next=a.finallyLoc,m):this.complete(o)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),m},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),P(n),m}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var i=r.arg;P(n)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,n){return this.delegate={iterator:E(t),resultName:e,nextLoc:n},"next"===this.method&&(this.arg=void 0),m}},t}function v(t,e,n,r,i,a,o){try{var s=t[a](o),l=s.value}catch(t){return void n(t)}s.done?e(l):Promise.resolve(l).then(r,i)}function m(t){return function(){var e=this,n=arguments;return new Promise((function(r,i){var a=t.apply(e,n);function o(t){v(a,r,i,o,s,"next",t)}function s(t){v(a,r,i,o,s,"throw",t)}o(void 0)}))}}var p=n(11).default,f={components:{moment:a.a,FullCalendar:o.a},data:function(){var t=this;return{showPopup:!1,showUpdate:!1,activeEvent:{start_time:"",end_time:""},activeItem:{},games:[],calendarOptions:{plugins:[c.a,s.f,l.a],initialDate:this.currentDate,scrollTime:this.startTime,locale:this.lang_str,direction:"rtl",buttonText:(this.lang_str,{today:"today",month:"month",week:"week",day:"day",list:"list"}),monthNames:"en"==this.lang_str?null:this.monthsNames,monthNamesShort:"en"==this.lang_str?null:this.monthsNames,dayNames:"en"==this.lang_str?null:this.daysNames,dayNamesShort:"en"==this.lang_str?null:this.daysNames,eventConstraint:"businessHours",initialView:"resourceTimeGridDay",schedulerLicenseKey:"0352628070-fcs-1640670544",titleFormat:{year:"numeric",month:"short",day:"numeric"},headerToolbar:this.headerViewsProvidersMethod(),resources:function(t,e){p.get("/api/calendar").then((function(t){e(t.data.data)}))},events:"/api/calendar_events",businessHours:!1,aspectRatio:1.2,nowIndicator:!0,slotDuration:"00:15:00",selectable:!0,selectMirror:!0,eventMaxStack:3,editable:!0,droppable:!0,weekends:!0,navLinks:!0,navLinkDayClick:!1,allDaySlot:!1,eventClick:function(e){t.activeEvent=e,t.setActiveItem(e.event.extendedProps).showPopup=!0},select:function(e){t.activeItem={},t.setNewItem(e).showPopup=!0},eventReceive:function(t){},eventContent:function(e,n){var r=e.event,i='<span class="w-full flex gsp-4 gsp">',a=e.event.extendedProps&&e.event.extendedProps.game?e.event.extendedProps.game:{picture:""},o=t.dateTime(r.end)+" - "+t.dateTime(r.start);return i+='<img src="'+(a?a.picture:"")+'" class="rounded-full w-8 h-8" />',i+="<span class='font-xxs font-bold text-left w-full'>"+r.title+" <br />"+o+"</span>",{html:i+="</span>"}},drop:function(t){console.log(t)},eventDrop:function(t){},eventResize:function(t){console.log(t)},eventMouseEnter:function(t,e,n){console.log("hover")},eventCreated:function(t){console.log(t)},eventClassNames:function(t){return["background-event-element bg-gradient-purple"]}}}},props:{sidebarLang:Object,buttonsText:Object,monthsNames:Array,daysNames:Array,daysOfWeek:Array,availableDays:Array,title:String,lang_str:String,startTime:String,endTime:String},mounted:function(){},methods:{dateTime:function(t){var e=new Date(t);return(e.getHours()>9?e.getHours():"0"+e.getHours())+":"+(e.getMinutes()>9?e.getMinutes():"0"+e.getMinutes())},dateText:function(t){var e=new Date(t);return e.getFullYear()+"-"+(e.getMonth()+1)+"-"+(e.getDate()>9?e.getDate():"0"+e.getDate())},reloadEvents:function(){this.$refs.calendar.getApi().refetchEvents()},headerViewsProvidersMethod:function(){return{left:this.title,right:this.headerViewsProviders,center:"prev,today,title,next"}},setNewItem:function(t){return this.games=t.resource.extendedProps.games,this.activeItem.device_id=t.resource.id,this.activeItem.start=this.dateTime(t.start),this.activeItem.end=this.dateTime(t.end),this.activeItem.startStr=t.startStr,this.activeItem.start_time=this.dateTime(t.startStr),this.activeItem.end_time=this.dateTime(t.endStr),this.activeItem.date=this.dateText(t.startStr),this.activeItem.booking_type="single",this},setActiveItem:function(t){return console.log(this.activeEvent),this.games=this.activeEvent.event.extendedProps.games,this.activeItem.id=this.activeEvent.event.id,this.activeItem.startStr=this.activeEvent.event.startStr,this.activeItem.start=this.dateTime(this.activeEvent.event.start),this.activeItem.end=this.dateTime(this.activeEvent.event.end),this.activeItem.end_time=t.end_time,this.activeItem.start_time=t.start_time,this.activeItem.break_time=t.break_time,this.activeItem.status=t.status,this.activeItem.device=t.device,this.activeItem.game=t.game,this.activeItem.game_id=t.game_id,this.activeItem.booking_type=t.booking_type,this},hidePopup:function(){this.showPopup=!1,this.showUpdate=!1},storeInfo:function(t){this.submit("Event.create")},updateInfo:function(t){return this.showPopup=!1,this.showUpdate=!0,this.showPopup=!0,this},submit:function(t){var e=this,n=this.activeItem.id?"update":"create",r=new URLSearchParams([]);r.append("type",t),r.append("params[event]",JSON.stringify(this.activeItem)),this.handleRequest(r,"/api/"+n).then((function(t){e.reloadEvents(),e.hidePopup()}))},handleRequest:function(t){var e=arguments;return m(d().mark((function n(){var r;return d().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return r=e.length>1&&void 0!==e[1]?e[1]:"/",n.next=3,p.post(r,t.toString()).then((function(t){return 1==t.data.status?t.data.result:t.data}));case 3:return n.abrupt("return",n.sent);case 4:case"end":return n.stop()}}),n)})))()}}},h=n(26),g=n.n(h),y=n(42),b={insert:"head",singleton:!1},w=(g()(y.a,b),y.a.locals,n(25)),_=Object(w.a)(f,r,[],!1,null,null,null);e.default=_.exports}}]);