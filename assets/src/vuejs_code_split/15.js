(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{25:function(t,e,r){"use strict";function n(t,e,r,n,a,o,i,s){var l,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),o&&(u._scopeId="data-v-"+o),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),a&&a.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},u._ssrRegister=l):a&&(l=s?function(){a.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:a),l)if(u.functional){u._injectStyles=l;var c=u.render;u.render=function(t,e){return l.call(e),c(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:u}}r.d(e,"a",(function(){return n}))},59:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"block w-full overflow-x-auto"},[t.Task?e("div",{staticClass:"w-full gap gap-6"},[e("div",{staticClass:"w-full"},[e("div",{staticClass:"card flex-fill"},[t._m(0),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Subject")]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.Task.name,expression:"Task.name"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"text",required:""},domProps:{value:t.Task.name},on:{input:function(e){e.target.composing||t.$set(t.Task,"name",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Description")]),t._v(" "),e("div",{staticClass:"w-full"},[e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.Task.description,expression:"Task.description"}],staticClass:"p-4 w-full border border-1 border-gray-200 rounded-lg",attrs:{rows:"5"},domProps:{value:t.Task.description},on:{input:function(e){e.target.composing||t.$set(t.Task,"description",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Start date")]),t._v(" "),e("div",{staticClass:"w-full flex"},[e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.Task.start_date,expression:"Task.start_date"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"date",required:""},domProps:{value:t.Task.start_date},on:{input:function(e){e.target.composing||t.$set(t.Task,"start_date",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.Task.start_time,expression:"Task.start_time"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"time",required:""},domProps:{value:t.Task.start_time},on:{input:function(e){e.target.composing||t.$set(t.Task,"start_time",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("End date")]),t._v(" "),e("div",{staticClass:"w-full flex"},[e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.Task.end_date,expression:"Task.end_date"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"date",min:t.Task.start_date,required:""},domProps:{value:t.Task.end_date},on:{input:function(e){e.target.composing||t.$set(t.Task,"end_date",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.Task.end_time,expression:"Task.end_time"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"time",required:""},domProps:{value:t.Task.end_time},on:{input:function(e){e.target.composing||t.$set(t.Task,"end_time",e.target.value)}}})])])])])])]),t._v(" "),e("div",{staticClass:"w-full"},[e("div",{staticClass:"card flex-fill"},[t._m(1),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Priority")]),t._v(" "),e("div",{staticClass:"w-full"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.Task.priority,expression:"Task.priority"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.Task,"priority",e.target.multiple?r:r[0])}}},[e("option",{attrs:{value:"medium"},domProps:{textContent:t._s("Medium")}}),t._v(" "),e("option",{attrs:{value:"high"},domProps:{textContent:t._s("High")}}),t._v(" "),e("option",{attrs:{value:"low"},domProps:{textContent:t._s("Low")}})])])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Type")]),t._v(" "),e("div",{staticClass:"w-full"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.Task.type,expression:"Task.type"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.Task,"type",e.target.multiple?r:r[0])}}},[e("option",{attrs:{value:"call"},domProps:{textContent:t._s("Call")}}),t._v(" "),e("option",{attrs:{value:"meeting"},domProps:{textContent:t._s("Meeting")}}),t._v(" "),e("option",{attrs:{value:"other"},domProps:{textContent:t._s("other")}})])])]),t._v(" "),t.Agents?e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Agent")]),t._v(" "),e("div",{staticClass:"w-full"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.Task.users,expression:"Task.users"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.Task,"users",e.target.multiple?r:r[0])}}},t._l(t.Agents,(function(r,n){return e("option",{domProps:{value:r.id,textContent:t._s(r.name)}})})),0)])]):t._e(),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Status")]),t._v(" "),e("div",{staticClass:"w-full"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.Task.status,expression:"Task.status"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.Task,"status",e.target.multiple?r:r[0])}}},t._l(t.statusList,(function(r){return e("option",{domProps:{value:t.Status.code,textContent:t._s(t.Status.name)}})})),0)])])])])])]):t._e(),t._v(" "),e("div",{staticClass:"w-full"},[e("div",{staticClass:"card flex-fill"},[e("div",{staticClass:"card-body"},[e("button",{staticClass:"bg-purple-600 px-4 py-2 text-sm text-white",attrs:{value:"Save"},on:{click:t.submit}},[t._v("Save")])])])])])};function a(t){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function o(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */o=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},i="function"==typeof Symbol?Symbol:{},s=i.iterator||"@@iterator",l=i.asyncIterator||"@@asyncIterator",u=i.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function d(t,e,r,a){var o=e&&e.prototype instanceof v?e:v,i=Object.create(o.prototype),s=new S(a||[]);return n(i,"_invoke",{value:C(t,r,s)}),i}function f(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=d;var p={};function v(){}function h(){}function m(){}var y={};c(y,s,(function(){return this}));var g=Object.getPrototypeOf,w=g&&g(g(E([])));w&&w!==e&&r.call(w,s)&&(y=w);var _=m.prototype=v.prototype=Object.create(y);function b(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){var o;n(this,"_invoke",{value:function(n,i){function s(){return new e((function(o,s){!function n(o,i,s,l){var u=f(t[o],t,i);if("throw"!==u.type){var c=u.arg,d=c.value;return d&&"object"==a(d)&&r.call(d,"__await")?e.resolve(d.__await).then((function(t){n("next",t,s,l)}),(function(t){n("throw",t,s,l)})):e.resolve(d).then((function(t){c.value=t,s(c)}),(function(t){return n("throw",t,s,l)}))}l(u.arg)}(n,i,o,s)}))}return o=o?o.then(s,s):s()}})}function C(t,e,r){var n="suspendedStart";return function(a,o){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===a)throw o;return P()}for(r.method=a,r.arg=o;;){var i=r.delegate;if(i){var s=k(i,r);if(s){if(s===p)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=f(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===p)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}function k(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,k(t,e),"throw"===e.method))return p;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return p}var n=f(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,p;var a=n.arg;return a?a.done?(e[t.resultName]=a.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,p):a:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,p)}function T(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function L(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(T,this),this.reset(!0)}function E(t){if(t){var e=t[s];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:P}}function P(){return{value:void 0,done:!0}}return h.prototype=m,n(_,"constructor",{value:m,configurable:!0}),n(m,"constructor",{value:h,configurable:!0}),h.displayName=c(m,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===h||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,m):(t.__proto__=m,c(t,u,"GeneratorFunction")),t.prototype=Object.create(_),t},t.awrap=function(t){return{__await:t}},b(x.prototype),c(x.prototype,l,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,a,o){void 0===o&&(o=Promise);var i=new x(d(e,r,n,a),o);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},b(_),c(_,u,"Generator"),c(_,s,(function(){return this})),c(_,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=E,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(L),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var a=this.tryEntries.length-1;a>=0;--a){var o=this.tryEntries[a],i=o.completion;if("root"===o.tryLoc)return n("end");if(o.tryLoc<=this.prev){var s=r.call(o,"catchLoc"),l=r.call(o,"finallyLoc");if(s&&l){if(this.prev<o.catchLoc)return n(o.catchLoc,!0);if(this.prev<o.finallyLoc)return n(o.finallyLoc)}else if(s){if(this.prev<o.catchLoc)return n(o.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return n(o.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var a=this.tryEntries[n];if(a.tryLoc<=this.prev&&r.call(a,"finallyLoc")&&this.prev<a.finallyLoc){var o=a;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,p):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),p},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),L(r),p}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var a=n.arg;L(r)}return a}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:E(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),p}},t}function i(t,e,r,n,a,o,i){try{var s=t[o](i),l=s.value}catch(t){return void r(t)}s.done?e(l):Promise.resolve(l).then(n,a)}function s(t){return function(){var e=this,r=arguments;return new Promise((function(n,a){var o=t.apply(e,r);function s(t){i(o,n,a,s,l,"next",t)}function l(t){i(o,n,a,s,l,"throw",t)}s(void 0)}))}}n._withStripped=!0;var l=r(11).default,u={computed:{},data:function(){return{statusList:[{code:"new",name:"New"},{code:"started",name:"Started"},{code:"finished",name:"Finished"},{code:"pending",name:"Pending"},{code:"canceled",name:"Canceled"}],Agents:[],file:null,Task:{id:0,name:"",description:"",start_time:"",start_date:"",type:"",status:"",files:[]}}},props:["old_agents","task","lang"],mounted:function(){this.Agents=this.old_agents,this.task&&(this.Task=this.task)},methods:{checkById:function(t){var e=this,r=new URLSearchParams([]);r.append("model","Task"),r.append("id",t),this.handleRequest(r).then((function(t){e.Task=t}))},addFile:function(){return this.showList=!1,this.Task.files.push({}),this.showList=!0,this},filterFiles:function(){return this.Task.files=this.Task.files.filter((function(t){return t})),this},pushToFiles:function(t,e){return this.Task.files.push(e),this},submit:function(){var t=this,e=this.Task.id?"update":"create",r=new URLSearchParams([]);r.append("type","Task."+e),r.append("params[task]",JSON.stringify(this.Task)),this.handleRequest(r,"/api/"+e).then((function(e){t.$alert(e.result)}))},handleRequest:function(t){var e=arguments;return s(o().mark((function r(){var n;return o().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return n=e.length>1&&void 0!==e[1]?e[1]:"/api",r.next=3,l.post(n,t.toString()).then((function(t){return t.data?t.data:"Error !"}));case 3:return r.abrupt("return",r.sent);case 4:case"end":return r.stop()}}),r)})))()},handleGetRequest:function(t){return s(o().mark((function e(){return o().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,l.get(t).then((function(t){if(t.data)return t.data}));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})))()}}},c=r(25),d=Object(c.a)(u,n,[function(){var t=this._self._c;return t("div",{staticClass:"card-header"},[t("h4",{staticClass:"card-title mb-0"},[this._v("Basic Information")])])},function(){var t=this._self._c;return t("div",{staticClass:"card-header"},[t("h4",{staticClass:"card-title mb-0"},[this._v("Other info")])])}],!1,null,null,null);e.default=d.exports}}]);