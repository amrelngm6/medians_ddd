(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{28:function(t,e,r){"use strict";function n(t,e,r,n,o,s,a,i){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),s&&(u._scopeId="data-v-"+s),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=c):o&&(c=i?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var p=u.beforeCreate;u.beforeCreate=p?[].concat(p,c):[c]}return{exports:t,options:u}}r.d(e,"a",(function(){return n}))},71:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"block w-full overflow-x-auto"},[t.showCart&&t.Items&&t.Items.length?e("div",[t.showLoader?e("div"):t._e(),t._v(" "),t.showLoader?t._e():e("div",{staticClass:"pt-20 fixed right-0 top-0 bg-white p-6 h-screen overflow-y-auto w-96 max-w-full",staticStyle:{"z-index":"9","max-height":"100vh"}},[t.Items?e("div",{staticClass:"modal-header"},[e("button",{staticClass:"btn-close xs-close",attrs:{type:"button","data-bs-dismiss":"modal"}})]):t._e(),t._v(" "),e("div",{staticClass:"modal-body"},[e("div",{staticClass:"mx-auto w-full"},[e("h1",{staticClass:"font-semibold text-2xl border-b py-8",domProps:{textContent:t._s(t.__("order_summary"))}}),t._v(" "),t.Items?e("div",{staticClass:"w-full"},t._l(t.Items,(function(r,n){return e("div",{key:n,staticClass:"w-full block"},[r?e("div",{staticClass:"flex justify-between mt-10 mb-5"},[r.device?e("span",{staticClass:"font-semibold text-sm"},[e("span",{domProps:{textContent:t._s(r.device.name)}}),e("br"),t._v(" "),r.game?e("span",{staticClass:"text-xs text-gray-400",domProps:{textContent:t._s(r.game.name)}}):t._e(),t._v(" "),e("span",{staticClass:"text-xs text-red-400",domProps:{textContent:t._s(t.__("remove"))},on:{click:function(e){return t.removeFromCart(r)}}})]):t._e(),t._v(" "),e("span",{staticClass:"font-semibold text-sm"},[e("span",{domProps:{textContent:t._s(r.subtotal)}}),t._v(" "),t.setting?e("small",{staticClass:"text-xs",domProps:{textContent:t._s(t.setting.currency)}}):t._e(),t._v(" "),e("br"),t._v(" "),e("span",{staticClass:"text-xs text-gray-400",domProps:{textContent:t._s(r.duration_time)}})])]):t._e(),t._v(" "),t._l(r.products,(function(n,o){return e("div",{key:o,staticClass:"w-full block"},[n&&r&&r.products?e("div",{staticClass:"flex justify-between mt-10 mb-5"},[e("span",{staticClass:"font-semibold text-sm"},[e("span",{domProps:{textContent:t._s(n.product.name)}}),e("br"),t._v(" "),n.qty?e("span",{staticClass:"text-xs text-gray-400",domProps:{textContent:t._s("X "+n.qty)}}):t._e()]),t._v(" "),e("span",{staticClass:"font-semibold text-sm"},[e("span",{domProps:{textContent:t._s(n.price)}}),t._v(" "),t.setting?e("small",{staticClass:"text-xs",domProps:{textContent:t._s(t.setting.currency)}}):t._e()])]):t._e()])}))],2)})),0):t._e(),t._v(" "),e("div",{staticClass:"py-10"},[e("label",{staticClass:"font-semibold inline-block mb-3 text-sm uppercase",attrs:{for:"promo"},domProps:{textContent:t._s(t.__("promo_code"))}}),t._v(" "),e("div",{staticClass:"flex w-full gap gap-1"},[e("input",{staticClass:"p-2 text-sm w-full",attrs:{type:"text",id:"promo",placeholder:"Enter your code"}}),t._v(" "),e("button",{staticClass:"bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase",domProps:{textContent:t._s(t.__("apply"))}})])]),t._v(" "),e("div",{staticClass:"w-full flex gap-1"},[e("label",{staticClass:"font-medium inline-block w-full my-3 text-sm uppercase",domProps:{textContent:t._s(t.__("payment_method"))}}),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.payment_method,expression:"payment_method"}],staticClass:"block p-2 text-gray-600 w-full text-sm",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.payment_method=e.target.multiple?r:r[0]}}},[e("option",{attrs:{value:"Cash"}},[t._v("Cash")])])]),t._v(" "),e("div",{staticClass:"border-t mt-8 w-full"},[e("div",{staticClass:"flex font-semibold justify-between py-6 text-sm uppercase"},[e("span",{staticClass:"w-full",domProps:{textContent:t._s(t.__("subtotal"))}}),t._v(" "),e("span",{staticClass:"flex w-full text-right text-lg gap gap-1 text-red-400"},[e("span",{domProps:{textContent:t._s(t.subtotal())}}),t._v(" "),e("span",{domProps:{textContent:t._s(t.currency)}})])]),t._v(" "),e("div",{staticClass:"flex font-semibold justify-between py-6 text-sm uppercase"},[e("span",{staticClass:"w-full",domProps:{textContent:t._s(t.__("tax"))}}),t._v(" "),e("span",{staticClass:"flex w-full text-right text-lg gap gap-1 text-red-400"},[e("span",{domProps:{textContent:t._s(t.tax())}}),t._v(" "),e("span",{domProps:{textContent:t._s(t.currency)}})])]),t._v(" "),e("div",{staticClass:"flex font-semibold justify-between py-6 text-sm uppercase"},[e("span",{staticClass:"w-full",domProps:{textContent:t._s(t.__("total_amount"))}}),t._v(" "),e("span",{staticClass:"flex w-full text-right text-lg gap gap-1 text-red-400"},[e("span",{domProps:{textContent:t._s(t.total())}}),t._v(" "),e("span",{domProps:{textContent:t._s(t.currency)}})])]),t._v(" "),e("button",{staticClass:"bg-gradient-primary font-semibold hover:bg-purple-600 py-3 text-sm text-white uppercase w-32 mx-auto block rounded-lg my-6",domProps:{textContent:t._s(t.__("checkout"))},on:{click:t.checkout}})])])])])]):t._e()])};function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function s(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */s=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},a="function"==typeof Symbol?Symbol:{},i=a.iterator||"@@iterator",c=a.asyncIterator||"@@asyncIterator",u=a.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,r){return t[e]=r}}function p(t,e,r,o){var s=e&&e.prototype instanceof f?e:f,a=Object.create(s.prototype),i=new k(o||[]);return n(a,"_invoke",{value:C(t,r,i)}),a}function h(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=p;var d={};function f(){}function m(){}function v(){}var y={};l(y,i,(function(){return this}));var _=Object.getPrototypeOf,x=_&&_(_(E([])));x&&x!==e&&r.call(x,i)&&(y=x);var g=v.prototype=f.prototype=Object.create(y);function w(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function b(t,e){var s;n(this,"_invoke",{value:function(n,a){function i(){return new e((function(s,i){!function n(s,a,i,c){var u=h(t[s],t,a);if("throw"!==u.type){var l=u.arg,p=l.value;return p&&"object"==o(p)&&r.call(p,"__await")?e.resolve(p.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(p).then((function(t){l.value=t,i(l)}),(function(t){return n("throw",t,i,c)}))}c(u.arg)}(n,a,s,i)}))}return s=s?s.then(i,i):i()}})}function C(t,e,r){var n="suspendedStart";return function(o,s){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw s;return S()}for(r.method=o,r.arg=s;;){var a=r.delegate;if(a){var i=I(a,r);if(i){if(i===d)continue;return i}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var c=h(t,e,r);if("normal"===c.type){if(n=r.done?"completed":"suspendedYield",c.arg===d)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n="completed",r.method="throw",r.arg=c.arg)}}}function I(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,I(t,e),"throw"===e.method))return d;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var n=h(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,d;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,d):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,d)}function L(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function P(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function k(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(L,this),this.reset(!0)}function E(t){if(t){var e=t[i];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:S}}function S(){return{value:void 0,done:!0}}return m.prototype=v,n(g,"constructor",{value:v,configurable:!0}),n(v,"constructor",{value:m,configurable:!0}),m.displayName=l(v,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,v):(t.__proto__=v,l(t,u,"GeneratorFunction")),t.prototype=Object.create(g),t},t.awrap=function(t){return{__await:t}},w(b.prototype),l(b.prototype,c,(function(){return this})),t.AsyncIterator=b,t.async=function(e,r,n,o,s){void 0===s&&(s=Promise);var a=new b(p(e,r,n,o),s);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},w(g),l(g,u,"Generator"),l(g,i,(function(){return this})),l(g,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=E,k.prototype={constructor:k,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(P),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var s=this.tryEntries[o],a=s.completion;if("root"===s.tryLoc)return n("end");if(s.tryLoc<=this.prev){var i=r.call(s,"catchLoc"),c=r.call(s,"finallyLoc");if(i&&c){if(this.prev<s.catchLoc)return n(s.catchLoc,!0);if(this.prev<s.finallyLoc)return n(s.finallyLoc)}else if(i){if(this.prev<s.catchLoc)return n(s.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<s.finallyLoc)return n(s.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var s=o;break}}s&&("break"===t||"continue"===t)&&s.tryLoc<=e&&e<=s.finallyLoc&&(s=null);var a=s?s.completion:{};return a.type=t,a.arg=e,s?(this.method="next",this.next=s.finallyLoc,d):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),P(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;P(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:E(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),d}},t}function a(t,e,r,n,o,s,a){try{var i=t[s](a),c=i.value}catch(t){return void r(t)}i.done?e(c):Promise.resolve(c).then(n,o)}function i(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var s=t.apply(e,r);function i(t){a(s,n,o,i,c,"next",t)}function c(t){a(s,n,o,i,c,"throw",t)}i(void 0)}))}}n._withStripped=!0;var c=r(14).default,u={data:function(){return{payment_method:"Cash",id:0,activeItem:{},ItemsIds:[],Items:[],sub_total:0,showLoader:!1,showCart:!1}},props:["setting","currency","cart_items"],mounted:function(){this.cart_items&&(this.Items=this.cart_items),console.log(this.Items)},methods:{removeFromCart:function(t){if(!t||t&&!t.id)return null;this.ItemsIds=[],this.showLoader=!0;for(var e=this.Items.length-1;e>=0;e--)this.Items[e]&&this.Items[e].id==t.id?delete this.Items[e]:this.Items[e]&&this.ItemsIds.push(this.Items[e].id);this.subtotal(),this.showLoader=!1},addToCart:function(t){console.log(t),this.checkDuplicate(t),this.subtotal()},checkDuplicate:function(t){return-1==this.ItemsIds.indexOf(t.id)&&(this.Items.push(t),this.ItemsIds.push(t.id)),this},subtotal:function(){this.sub_total=0;for(var t=this.Items.length-1;t>=0;t--)if(this.sub_total=this.Items[t]?Number(this.sub_total)+Number(this.Items[t].subtotal):0,this.Items[t]&&this.Items[t].products&&this.Items[t].products.length>0)for(var e=this.Items[t].products.length-1;e>=0;e--)this.sub_total=this.Items[t].products[e]?Number(this.sub_total)+Number(this.Items[t].products[e].price):this.sub_total;return this.sub_total.toFixed(2)},checkout:function(){var t=this;this.showLoader=!0;var e=new URLSearchParams([]);e.append("type","checkout"),e.append("params[cart]",JSON.stringify(this.Items)),e.append("params[payment_method]",this.payment_method),this.handleRequest(e,"/api/checkout").then((function(e){t.showLoader=!1,t.$alert(e),t.Items=[],t.$parent.reloadEvents()}))},query:function(t){var e=this,r=new URLSearchParams([]);r.append("type","OrderDevice"),r.append("model","OrderDevice"),r.append("id",t),this.showPopup=!1,this.handleRequest(r,"/api").then((function(t){e.addToCart(t),e.showPopup=!0})),this.showPopup=!0},removeProduct:function(t){var e=this,r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;this.showLoader=!0;var n=new URLSearchParams([]);n.append("type","OrderDevice.removeProduct"),n.append("params[product]",JSON.stringify(t)),this.handleRequest(n,"/api/delete").then((function(t){e.showLoader=!1,e.query(e.Items[r].id,r)}))},handleRequest:function(t){var e=arguments;return i(s().mark((function r(){var n;return s().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return n=e.length>1&&void 0!==e[1]?e[1]:"/api",r.next=3,c.post(n,t.toString()).then((function(t){return t.data.status?t.data.result:t.data}));case 3:return r.abrupt("return",r.sent);case 4:case"end":return r.stop()}}),r)})))()},handleGetRequest:function(t){var e=this;return i(s().mark((function r(){var n;return s().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return n=e,r.next=3,c.get(t).then((function(t){return n.showLoader=!1,t.data.status?t.data.result:t.data}));case 3:return r.abrupt("return",r.sent);case 4:case"end":return r.stop()}}),r)})))()},__:function(t){return this.$parent.__(t)}}},l=r(28),p=Object(l.a)(u,n,[],!1,null,null,null);e.default=p.exports}}]);