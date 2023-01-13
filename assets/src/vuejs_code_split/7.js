(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{28:function(t,e,r){"use strict";function n(t,e,r,n,o,i,a,s){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),i&&(u._scopeId="data-v-"+i),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=c):o&&(c=s?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:u}}r.d(e,"a",(function(){return n}))},67:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full"},[t.showLoader||!t.activeItem||t.$parent.showConfirm||t.activeItem.status&&"active"!=t.activeItem.status?t._e():e("div",{staticClass:"relative w-full h-full"},[e("div",{staticClass:"top-20 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto",staticStyle:{"max-width":"600px","max-height":"500px"}},[e("div",{staticClass:"w-full block gap-4 py-2 border-b border-gray-200"},[t.activeItem.id?e("div",{staticClass:"cursor-pointer absolute right-4 top-4",on:{click:function(e){t.$parent.showConfirm=!0}}},[t._m(0)]):t._e(),t._v(" "),e("label",{staticClass:"w-full"},[t._v("Game")]),t._v(" "),e("div",{staticClass:"w-full block gap-4 my-2 text-gray-600 overflow-x-auto"},[t.games?e("div",{staticClass:"overflow-x-auto",style:{"min-width":35*t.games.length+"%"}},t._l(t.games,(function(r){return e("label",{staticClass:"inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold",class:t.activeItem.game_id==r.id?"bg-purple-600 text-white":"border-purple-600 text-purple-800",attrs:{for:"single-"+r.id},on:{click:function(e){t.activeItem.game_id=r.id,t.updateInfo(t.activeItem)}}},[e("img",{staticClass:"mx-auto w-6 h-6 rounded-full my-2",attrs:{src:r.picture}}),t._v(" "),e("span",{domProps:{textContent:t._s(r.name)}}),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.game_id,expression:"activeItem.game_id"}],staticClass:"hidden",attrs:{id:"id-"+r.id,type:"radio",name:"game_id"},domProps:{value:r.id,checked:t._q(t.activeItem.game_id,r.id)},on:{change:[function(e){return t.$set(t.activeItem,"game_id",r.id)},function(e){return t.updateInfo(t.activeItem)}]}})])})),0):t._e()])]),t._v(" "),t.activeItem.products&&t.activeItem.products.length?e("div",{staticClass:"pb-4"},[e("span",{staticClass:"text-md font-semibold w-full block py-4"},[t._v("Purchased Products")]),t._v(" "),t._l(t.activeItem.products,(function(r){return r?e("div",{staticClass:"font-semibold w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full text-purple-600",domProps:{textContent:t._s(r.product_name)}}),t._v(" "),"paid"!=t.activeItem.status?e("span",{staticClass:"w-40 text-md p-2 text-red-600",on:{click:function(e){return t.removeProduct(r)}}},[t._v("Remove")]):t._e(),t._v(" "),e("span",{staticClass:"w-20 flex text-md p-2 text-right"},[e("span",{domProps:{textContent:t._s(r.price)}}),t._v(" "),e("span",{staticClass:"px-1 text-sm",domProps:{textContent:t._s(t.activeItem.currency)},on:{click:function(e){return t.query(r)}}})])]):t._e()})),t._v(" "),e("div",{staticClass:"font-semibold w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full text-purple-600"}),t._v(" "),e("input",{staticClass:"w-full text-lg p-2 text-red-600 text-right",attrs:{disabled:""},domProps:{value:t.products_subtotal()+" "+t.activeItem.currency}})])],2):t._e(),t._v(" "),t.activeItem.id?e("div",{staticClass:"w-full block"},[t.products&&t.products.length?e("div",{staticClass:"pb-4"},[e("span",{staticClass:"text-red-600 text-md font-semibold w-full block my-4 cursor-pointer py-2 px-4 rounded-lg border border-gray-200",on:{click:function(e){return t.viwMoreProducts()}}},[t._v("Add More Products")]),t._v(" "),t._l(t.products,(function(r){return r&&t.showMoreProducts?e("div",{staticClass:"font-semibold w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full text-purple-600",domProps:{textContent:t._s(r.name)}}),t._v(" "),e("span",{staticClass:"w-40 text-md p-2 text-purple-600",on:{click:function(e){return t.addProduct(r)}}},[t._v("Add to cart")]),t._v(" "),e("span",{staticClass:"w-20 flex text-md p-2 text-right"},[e("span",{domProps:{textContent:t._s(r.price)}}),t._v(" "),e("span",{staticClass:"px-1 text-sm",domProps:{textContent:t._s(t.activeItem.currency)},on:{click:function(e){return t.query(r)}}})])]):t._e()}))],2):t._e()]):t._e(),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("Start")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.start_time,expression:"activeItem.start_time"}],staticClass:"w-full",attrs:{type:"time"},domProps:{value:t.activeItem.start_time},on:{change:function(e){return t.updateInfo(t.activeItem)},input:function(e){e.target.composing||t.$set(t.activeItem,"start_time",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full"},[t._v("End")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.end_time,expression:"activeItem.end_time"}],staticClass:"w-full",attrs:{type:"time"},domProps:{value:t.activeItem.end_time},on:{change:function(e){return t.updateInfo(t.activeItem)},input:function(e){e.target.composing||t.$set(t.activeItem,"end_time",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"w-full flex gap-6 my-2 text-gray-600"},[e("label",{staticClass:"cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold",class:"single"==t.activeItem.booking_type?"bg-purple-600 text-white":"",attrs:{for:"single"},on:{click:function(e){t.activeItem.booking_type="single",t.updateInfo(t.activeItem)}}},[t._v("Single "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.booking_type,expression:"activeItem.booking_type"}],staticClass:"hidden",attrs:{id:"signle",value:"single",type:"radio",name:"booking_type"},domProps:{checked:t._q(t.activeItem.booking_type,"single")},on:{change:function(e){return t.$set(t.activeItem,"booking_type","single")}}})]),t._v(" "),e("label",{staticClass:"cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold",class:"multi"==t.activeItem.booking_type?"bg-purple-600 text-white":"",attrs:{for:"multi"},on:{click:function(e){t.activeItem.booking_type="multi",t.updateInfo(t.activeItem)}}},[t._v("Multi "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.booking_type,expression:"activeItem.booking_type"}],staticClass:"hidden",attrs:{id:"multi",value:"multi",type:"radio",name:"booking_type"},domProps:{checked:t._q(t.activeItem.booking_type,"multi")},on:{change:function(e){return t.$set(t.activeItem,"booking_type","multi")}}})])]),t._v(" "),t.activeItem.id?t._e():e("div",{staticClass:"mt-10 w-32 block mx-auto text-white font-semibold py-2 border-b border-gray-200"},[e("label",{staticClass:"cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary block",on:{click:function(e){return t.$parent.storeInfo(t.activeItem)}}},[t._v("Start Playing")])]),t._v(" "),t.activeItem.id&&t.$parent.showUpdate?e("div",{staticClass:"mt-10 w-32 block mx-auto text-white text-center font-semibold py-2 border-b border-gray-200"},[e("label",{staticClass:"cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary",on:{click:function(e){return t.$parent.submit("Event.update")}}},[t._v("Update")])]):t._e()])])])};function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function i(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */i=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},a="function"==typeof Symbol?Symbol:{},s=a.iterator||"@@iterator",c=a.asyncIterator||"@@asyncIterator",u=a.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,r){return t[e]=r}}function d(t,e,r,o){var i=e&&e.prototype instanceof v?e:v,a=Object.create(i.prototype),s=new L(o||[]);return n(a,"_invoke",{value:I(t,r,s)}),a}function p(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=d;var f={};function v(){}function m(){}function h(){}var y={};l(y,s,(function(){return this}));var g=Object.getPrototypeOf,_=g&&g(g(S([])));_&&_!==e&&r.call(_,s)&&(y=_);var b=h.prototype=v.prototype=Object.create(y);function w(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){var i;n(this,"_invoke",{value:function(n,a){function s(){return new e((function(i,s){!function n(i,a,s,c){var u=p(t[i],t,a);if("throw"!==u.type){var l=u.arg,d=l.value;return d&&"object"==o(d)&&r.call(d,"__await")?e.resolve(d.__await).then((function(t){n("next",t,s,c)}),(function(t){n("throw",t,s,c)})):e.resolve(d).then((function(t){l.value=t,s(l)}),(function(t){return n("throw",t,s,c)}))}c(u.arg)}(n,a,i,s)}))}return i=i?i.then(s,s):s()}})}function I(t,e,r){var n="suspendedStart";return function(o,i){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw i;return E()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var s=C(a,r);if(s){if(s===f)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var c=p(t,e,r);if("normal"===c.type){if(n=r.done?"completed":"suspendedYield",c.arg===f)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n="completed",r.method="throw",r.arg=c.arg)}}}function C(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,C(t,e),"throw"===e.method))return f;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return f}var n=p(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,f;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,f):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,f)}function k(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function P(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function L(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(k,this),this.reset(!0)}function S(t){if(t){var e=t[s];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:E}}function E(){return{value:void 0,done:!0}}return m.prototype=h,n(b,"constructor",{value:h,configurable:!0}),n(h,"constructor",{value:m,configurable:!0}),m.displayName=l(h,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,l(t,u,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},w(x.prototype),l(x.prototype,c,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,o,i){void 0===i&&(i=Promise);var a=new x(d(e,r,n,o),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},w(b),l(b,u,"Generator"),l(b,s,(function(){return this})),l(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=S,L.prototype={constructor:L,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(P),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],a=i.completion;if("root"===i.tryLoc)return n("end");if(i.tryLoc<=this.prev){var s=r.call(i,"catchLoc"),c=r.call(i,"finallyLoc");if(s&&c){if(this.prev<i.catchLoc)return n(i.catchLoc,!0);if(this.prev<i.finallyLoc)return n(i.finallyLoc)}else if(s){if(this.prev<i.catchLoc)return n(i.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return n(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,f):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),f},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),P(r),f}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;P(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:S(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),f}},t}function a(t,e,r,n,o,i,a){try{var s=t[i](a),c=s.value}catch(t){return void r(t)}s.done?e(c):Promise.resolve(c).then(n,o)}function s(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var i=t.apply(e,r);function s(t){a(i,n,o,s,c,"next",t)}function c(t){a(i,n,o,s,c,"throw",t)}s(void 0)}))}}n._withStripped=!0;var c=r(14).default,u={data:function(){return{showLoader:!1,showMoreProducts:!1,activeItem:{}}},props:["modal","products","games"],mounted:function(){this.modal&&(this.activeItem=this.modal)},methods:{products_subtotal:function(){var t=0;if(this.activeItem.products)for(var e=this.activeItem.products.length-1;e>=0;e--)this.activeItem.products[e]&&(t=Number(this.activeItem.products[e].subtotal)+Number(t));return t},viwMoreProducts:function(){this.showMoreProducts=!this.showMoreProducts},updateInfo:function(t){this.showLoader=!0,this.$parent.updateInfo(t),this.showLoader=!1},query:function(){var t=this,e=new URLSearchParams([]);e.append("type","OrderDevice"),e.append("model","OrderDevice"),e.append("id",this.activeItem.id),this.handleRequest(e,"/api").then((function(e){t.activeItem=e,t.activeItem.start_time=t.$parent.dateTime(e.start_time),t.activeItem.end_time=t.$parent.dateTime(e.end_time)}))},addProduct:function(t){var e=this,r=new URLSearchParams([]);r.append("type","OrderDevice.addProduct"),r.append("model","OrderDevice"),r.append("params[product]",JSON.stringify(t)),r.append("params[device]",JSON.stringify(this.activeItem)),this.handleRequest(r,"/api/create").then((function(t){e.query(),e.$alert(t)}))},removeProduct:function(t){var e=this,r=new URLSearchParams([]);r.append("type","OrderDevice.removeProduct"),r.append("params[product]",JSON.stringify(t)),this.handleRequest(r,"/api/delete").then((function(t){e.query()}))},handleRequest:function(t){var e=arguments,r=this;return s(i().mark((function n(){var o,a;return i().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return o=e.length>1&&void 0!==e[1]?e[1]:"/",(a=r).showLoader=!0,n.next=5,c.post(o,t.toString()).then((function(t){return a.showLoader=!1,t.data.status?t.data.result:t.data}));case 5:return n.abrupt("return",n.sent);case 6:case"end":return n.stop()}}),n)})))()}}},l=r(28),d=Object(l.a)(u,n,[function(){var t=this._self._c;return t("div",{staticClass:"w-full flex gap gap-4"},[t("span",{staticClass:"text-lg font-semibold text-red-600"},[this._v("Finish")])])}],!1,null,null,null);e.default=d.exports}}]);