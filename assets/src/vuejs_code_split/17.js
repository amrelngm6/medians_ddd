(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{28:function(t,e,r){"use strict";function n(t,e,r,n,o,a,i,s){var l,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),a&&(u._scopeId="data-v-"+a),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},u._ssrRegister=l):o&&(l=s?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(u.functional){u._injectStyles=l;var c=u.render;u.render=function(t,e){return l.call(e),c(t,e)}}else{var f=u.beforeCreate;u.beforeCreate=f?[].concat(f,l):[l]}return{exports:t,options:u}}r.d(e,"a",(function(){return n}))},73:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"block w-full overflow-x-auto"},[t.User?e("div",{staticClass:"w-full lg:flex gap gap-6"},[e("div",{staticClass:"w-full"},[e("div",{staticClass:"card flex-fill"},[t._m(0),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("First name")]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.User.first_name,expression:"User.first_name"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"text",required:""},domProps:{value:t.User.first_name},on:{input:function(e){e.target.composing||t.$set(t.User,"first_name",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Last name")]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.User.last_name,expression:"User.last_name"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"text",required:""},domProps:{value:t.User.last_name},on:{input:function(e){e.target.composing||t.$set(t.User,"last_name",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Phone")]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.User.phone,expression:"User.phone"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"tel",required:""},domProps:{value:t.User.phone},on:{input:function(e){e.target.composing||t.$set(t.User,"phone",e.target.value)}}})])])])])]),t._v(" "),e("div",{staticClass:"w-full"},[e("div",{staticClass:"card flex-fill"},[t._m(1),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Email")]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.User.email,expression:"User.email"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"email"},domProps:{value:t.User.email},on:{input:function(e){e.target.composing||t.$set(t.User,"email",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Password")]),t._v(" "),e("div",{staticClass:"w-full"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.User.password,expression:"User.password"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",attrs:{type:"password"},domProps:{value:t.User.password},on:{input:function(e){e.target.composing||t.$set(t.User,"password",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"gap gap-6 w-full flex py-2"},[e("label",{staticClass:"w-full col-form-label"},[t._v("Status")]),t._v(" "),e("div",{staticClass:"w-full"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.User.active,expression:"User.active"}],staticClass:"h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.User,"active",e.target.multiple?r:r[0])}}},[e("option",{attrs:{value:"1"}},[t._v("Active")]),t._v(" "),e("option",{attrs:{value:"0"}},[t._v("In-Active")])])])])])])])]):t._e(),t._v(" "),e("div",{staticClass:"w-full"},[e("div",{staticClass:"card flex-fill"},[e("div",{staticClass:"card-body"},[e("button",{staticClass:"bg-purple-600 px-4 py-2 text-sm text-white",attrs:{value:"Save"},on:{click:t.submit}},[t._v("Save")])])])])])};function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function a(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */a=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},i="function"==typeof Symbol?Symbol:{},s=i.iterator||"@@iterator",l=i.asyncIterator||"@@asyncIterator",u=i.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function f(t,e,r,o){var a=e&&e.prototype instanceof h?e:h,i=Object.create(a.prototype),s=new S(o||[]);return n(i,"_invoke",{value:U(t,r,s)}),i}function p(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=f;var d={};function h(){}function v(){}function m(){}var y={};c(y,s,(function(){return this}));var g=Object.getPrototypeOf,w=g&&g(g(P([])));w&&w!==e&&r.call(w,s)&&(y=w);var _=m.prototype=h.prototype=Object.create(y);function b(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){var a;n(this,"_invoke",{value:function(n,i){function s(){return new e((function(a,s){!function n(a,i,s,l){var u=p(t[a],t,i);if("throw"!==u.type){var c=u.arg,f=c.value;return f&&"object"==o(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,s,l)}),(function(t){n("throw",t,s,l)})):e.resolve(f).then((function(t){c.value=t,s(c)}),(function(t){return n("throw",t,s,l)}))}l(u.arg)}(n,i,a,s)}))}return a=a?a.then(s,s):s()}})}function U(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return O()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var s=C(i,r);if(s){if(s===d)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=p(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===d)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}function C(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,C(t,e),"throw"===e.method))return d;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var n=p(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,d;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,d):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,d)}function L(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function E(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(L,this),this.reset(!0)}function P(t){if(t){var e=t[s];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:O}}function O(){return{value:void 0,done:!0}}return v.prototype=m,n(_,"constructor",{value:m,configurable:!0}),n(m,"constructor",{value:v,configurable:!0}),v.displayName=c(m,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,m):(t.__proto__=m,c(t,u,"GeneratorFunction")),t.prototype=Object.create(_),t},t.awrap=function(t){return{__await:t}},b(x.prototype),c(x.prototype,l,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new x(f(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},b(_),c(_,u,"Generator"),c(_,s,(function(){return this})),c(_,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=P,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(E),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var s=r.call(a,"catchLoc"),l=r.call(a,"finallyLoc");if(s&&l){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(s){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,d):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),E(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;E(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:P(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),d}},t}function i(t,e,r,n,o,a,i){try{var s=t[a](i),l=s.value}catch(t){return void r(t)}s.done?e(l):Promise.resolve(l).then(n,o)}function s(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var a=t.apply(e,r);function s(t){i(a,n,o,s,l,"next",t)}function l(t){i(a,n,o,s,l,"throw",t)}s(void 0)}))}}n._withStripped=!0;var l=r(14).default,u={computed:{},data:function(){return{tabs:[{title:"Info",code:"info"},{title:"Pictures",code:"pictures"},{title:"Activities",code:"activities"}],currentTab:"info",file:null,User:{id:0,first_name:"",last_name:"",email:"",phone:"",password:"",files:[]},showList:!0}},props:["site_url","user","lang","role_id"],mounted:function(){this.user&&(this.User=this.user)},methods:{addTask:function(){},addFile:function(){return this.showList=!1,this.User.files.push({}),this.showList=!0,this},filterFiles:function(){return this.User.files=this.User.files.filter((function(t){return t})),this},pushToFiles:function(t,e){return this.User.files.push(e),this},setTab:function(t){return this.currentTab=t,this},__:function(t){return(t.charAt(0).toUpperCase()+t.slice(1)).replace("_"," ")},submit:function(){var t=this,e=new URLSearchParams([]),r=this.User.id?"update":"create";e.append("type","User."+r),this.User.id&&e.append("params[user][id]",this.User.id),e.append("params[user][first_name]",this.User.first_name?this.User.first_name:""),e.append("params[user][last_name]",this.User.last_name?this.User.last_name:""),e.append("params[user][password]",this.User.password?this.User.password:""),e.append("params[user][phone]",this.User.phone?this.User.phone:""),e.append("params[user][email]",this.User.email?this.User.email:""),e.append("params[user][role_id]",this.User.role_id?this.User.role_id:this.role_id),e.append("params[user][active]",this.User.active?this.User.active:0),this.handleRequest(e,"/api/"+r).then((function(e){t.$alert(e.result)}))},handleRequest:function(t){var e=arguments;return s(a().mark((function r(){var n;return a().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return n=e.length>1&&void 0!==e[1]?e[1]:"/",r.next=3,l.post(n,t.toString()).then((function(t){return t.data}));case 3:return r.abrupt("return",r.sent);case 4:case"end":return r.stop()}}),r)})))()}}},c=r(28),f=Object(c.a)(u,n,[function(){var t=this._self._c;return t("div",{staticClass:"card-header"},[t("h4",{staticClass:"card-title mb-0"},[this._v("Basic Information")])])},function(){var t=this._self._c;return t("div",{staticClass:"card-header"},[t("h4",{staticClass:"card-title mb-0"},[this._v("Assigned info")])])}],!1,null,null,null);e.default=f.exports}}]);