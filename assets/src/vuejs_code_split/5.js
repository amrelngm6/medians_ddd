(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{28:function(e,i,n){"use strict";function t(e,i,n,t,r,a,l,_){var d,s="function"==typeof e?e.options:e;if(i&&(s.render=i,s.staticRenderFns=n,s._compiled=!0),t&&(s.functional=!0),a&&(s._scopeId="data-v-"+a),l?(d=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(l)},s._ssrRegister=d):r&&(d=_?function(){r.call(this,(s.functional?this.parent:this).$root.$options.shadowRoot)}:r),d)if(s.functional){s._injectStyles=d;var o=s.render;s.render=function(e,i){return d.call(i),o(e,i)}}else{var c=s.beforeCreate;s.beforeCreate=c?[].concat(c,d):[d]}return{exports:e,options:s}}n.d(i,"a",(function(){return t}))},31:function(e,i,n){"use strict";var t=n(11),r=n.n(t)()((function(e){return e[1]}));r.push([e.i,"\n.loading .svg {\n    width: 40px;\n    height: 40px;\n}\n.loading path {\n    fill: #333;\n}\n",""]),i.a=r},32:function(e,i,n){"use strict";var t=function(){var e=this._self._c;return e("div",{staticClass:"loading"},[e("svg",{staticStyle:{"enable-background":"new 0 0 50 50"},attrs:{version:"1.1",id:"loader-1",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",x:"0px",y:"0px",width:"40px",height:"40px",viewBox:"0 0 50 50","xml:space":"preserve"}},[e("path",{attrs:{d:"M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z"}},[e("animateTransform",{attrs:{attributeType:"xml",attributeName:"transform",type:"rotate",from:"0 25 25",to:"360 25 25",dur:"0.6s",repeatCount:"indefinite"}})],1)])])};t._withStripped=!0;var r={name:"vue-medialibrary-loader"},a=n(10),l=n.n(a),_=n(31),d={insert:"head",singleton:!1},s=(l()(_.a,d),_.a.locals,n(28)),o=Object(s.a)(r,t,[],!1,null,null,null);i.a=o.exports},59:function(e,i,n){"use strict";var t=n(11),r=n.n(t)()((function(e){return e[1]}));r.push([e.i,'\n.media-library-field {\n  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;\n}\n.media-library-field * {\n  box-sizing: border-box;\n}\n.media-library-field__selected, .media-library-field__selector, .media-library-field__loader {\n  display: block;\n  position: relative;\n  padding: 0.75rem;\n  width: 100%;\n  min-height: 1rem;\n  background: transparent;\n  border: 1px solid #a0aec0;\n  text-align: left;\n}\n.media-library-field__selected__button, .media-library-field__selector__button, .media-library-field__loader__button {\n  padding: 0.25rem 1rem;\n  border: 1px solid #718096;\n  border-radius: 0.875rem;\n  font-size: 0.875rem;\n  line-height: 1;\n  color: #718096;\n  appearance: none;\n  cursor: pointer;\n  transition: all 0.2s ease-in-out;\n}\n.media-library-field__selected__button:hover, .media-library-field__selector__button:hover, .media-library-field__loader__button:hover {\n  border-color: #2D3748;\n  color: #2D3748;\n}\n.media-library-field__selected__helper, .media-library-field__selector__helper, .media-library-field__loader__helper {\n  position: absolute;\n  float: right;\n  top: 50%;\n  right: 1rem;\n  transform: translateY(-50%);\n  font-size: 0.875rem;\n  color: #718096;\n}\n.media-library-field__loader {\n  text-align: center;\n}\n.media-library-field__selected {\n  padding: 1rem;\n}\n.media-library-field__selected__inner {\n  display: flex;\n  flex-direction: row;\n  flex-wrap: nowrap;\n  align-items: center;\n  align-content: flex-start;\n}\n.media-library-field__selected__inner__details {\n  flex-grow: 1;\n  padding: 0 1rem;\n}\n.media-library-field__selected__inner__details__helper {\n  display: block;\n  margin: 2rem 0 0 0;\n  font-size: 0.875rem;\n  color: #718096;\n}\n.media-library-field__selected__inner__details__button {\n  display: block;\n  width: 100%;\n  padding: 0.5rem 0.75rem;\n  background: transparent;\n  border: 1px solid #a0aec0;\n  border-radius: 9999px;\n  font-size: 0.75rem;\n  color: #718096;\n  text-align: center;\n  text-decoration: none;\n  cursor: pointer;\n  transition: all 0.2s ease-in-out;\n}\n.media-library-field__selected__inner__details__button:hover {\n  border-color: #4299E1;\n  background: #4299E1;\n  color: white;\n}\n.media-library-field__selected__inner__details__button--delete {\n  border-color: #e53e3e;\n  color: #e53e3e;\n}\n.media-library-field__selected__inner__details__button--delete:hover {\n  border-color: #e53e3e;\n  background: #e53e3e;\n  color: white;\n}\n.media-library-field__selected__inner__details__name, .media-library-field__selected__inner__details__dimensions, .media-library-field__selected__inner__details__edit {\n  display: block;\n}\n.media-library-field__selected__inner__details__name {\n  margin-bottom: 0.5rem;\n  font-size: 1rem;\n  font-weight: 400;\n  color: #2D3748;\n}\n.media-library-field__selected__inner__details__dimensions, .media-library-field__selected__inner__details__edit {\n  font-size: 0.875rem;\n  font-weight: 300;\n  color: #718096;\n}\n.media-library-field__selected__inner__details__edit {\n  margin-top: 0.5rem;\n  color: #4299E1;\n  cursor: pointer;\n}\n.media-library-field__selected__inner__details__edit:hover {\n  text-decoration: underline;\n}\n.media-library-field__selected__inner__img {\n  position: relative;\n  width: 33.33%;\n  max-width: 15rem;\n  min-width: 6.25rem;\n}\n.media-library-field__selected__inner__img__edit {\n  display: none;\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  background: rgba(255, 255, 255, 0.4);\n  cursor: pointer;\n}\n.media-library-field__selected__inner__img__edit > * {\n  position: absolute;\n  top: 50%;\n  left: 50%;\n  transform: translate(-50%, -50%);\n  font-size: 1.25rem;\n  font-weight: bold;\n  color: #2D3748;\n  text-transform: uppercase;\n}\n.media-library-field__selected__inner__img:hover .media-library-field__selected__inner__img__edit {\n  display: block;\n}\n.media-library-field__selected__inner__img__frame {\n  position: relative;\n  width: 100%;\n  padding-bottom: 100%;\n  overflow: hidden;\n}\n.media-library-field__selected__inner__img__frame__image {\n  display: flex;\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  background-color: #F7FAFC;\n  background-size: cover;\n  background-repeat: no-repeat;\n  background-position: center center;\n}\n\n',""]),i.a=r},64:function(e,i,n){"use strict";n.r(i);var t=function(){var e=this,i=e._self._c;return i("div",[i("div",{staticClass:"media-library-field"},[e.loading?i("div",{staticClass:"media-library-field__loader"},[i("app-medialibrary-loader")],1):null==e.content?i("div",{staticClass:"media-library-field__selector"},[i("span",{staticClass:"media-library-field__selector__button",on:{click:function(i){e.showManager=!0}}},[e._v("Attach "+e._s(e.types.images&&e.types.files?"file":e.types.images&&!e.types.files?"image":"file"))]),e._v(" "),e.helper?i("p",{staticClass:"media-library-field__selector__helper",domProps:{innerHTML:e._s(e.helper)}}):e._e()]):e.file?i("div",{staticClass:"media-library-field__selected"},[i("div",{staticClass:"media-library-field__selected__inner"},["images"==e.file.collection_name?i("div",{staticClass:"media-library-field__selected__inner__img",on:{click:function(i){e.showManager=!0}}},[i("div",{staticClass:"media-library-field__selected__inner__img__frame"},[i("div",{staticClass:"media-library-field__selected__inner__img__frame__image",style:"background-image: url('".concat(e.file.data_url,"');")})]),e._v(" "),e._m(0)]):e._e(),e._v(" "),i("div",{staticClass:"w-full flex gap gap-6"},[i("div",[i("img",{staticStyle:{width:"auto",height:"auto","max-width":"180px"},attrs:{src:e.file.data_url}})]),e._v(" "),i("div",[i("span",{staticClass:"media-library-field__selected__inner__details__name"},[e._v(e._s(e.file.file_name))]),e._v(" "),"images"==e.file.collection_name?i("span",{staticClass:"media-library-field__selected__inner__details__dimensions"},[e._v("Dimensions: "+e._s(e.file.image.width)+" × "+e._s(e.file.image.height))]):e._e(),e._v(" "),i("span",{staticClass:"media-library-field__selected__inner__details__edit",on:{click:function(i){e.showManager=!0}}},[e._v("Edit info")]),e._v(" "),i("div",{staticStyle:{display:"flex",margin:"2rem -0.5rem 0 -0.5rem"}},[i("div",{staticStyle:{"flex-grow":"1",padding:"0 0.5rem"}},[i("a",{staticClass:"media-library-field__selected__inner__details__button",attrs:{href:e.file.download_url}},[e._v("Download")])]),e._v(" "),i("div",{staticStyle:{"flex-grow":"1",padding:"0 0.5rem"}},[i("button",{staticClass:"media-library-field__selected__inner__details__button media-library-field__selected__inner__details__button--delete",on:{click:e.clear}},[e._v("Remove")])])])])])])]):e._e()]),e._v(" "),i("vue-medialibrary-manager",{directives:[{name:"show",rawName:"v-show",value:e.showManager,expression:"showManager"}],attrs:{api_url:e.api_url,filetypes:e.filetypes,types:e.types,selected:e.value,selectable:!0},on:{close:function(i){e.showManager=!1},select:e.insert,"fail-to-find":e.clear}})],1)};t._withStripped=!0;var r={name:"vue-medialibrary-field",components:{"app-medialibrary-loader":n(32).a},props:{api_url:{type:String,required:!1},value:{type:Object,required:!1,default:function(){return{}}},types:{type:Object,required:!1,default:function(){return{images:!0,files:!0}}},filetypes:{type:Array,required:!1,default:function(){return[]}},helper:{type:String,required:!1}},data:function(){return{loading:!0,showManager:!1,file:{},content:null}},mounted:function(){this.content=this.value?this.value:this.content,this.content&&this.content.file_name?this.file=this.value:this.content=null,this.loading=!1},methods:{insert:function(e){this.loading=!1,this.showManager=!1,this.file=e,this.content=e.file_name,this.change()},clear:function(){this.loading=!1,this.content=this.file=null,this.$emit("input",null)},change:function(){this.$emit("input",this.file)}},watch:{value:function(){void 0===this.file.id&&(this.loading=!0)}}},a=n(10),l=n.n(a),_=n(59),d={insert:"head",singleton:!1},s=(l()(_.a,d),_.a.locals,n(28)),o=Object(s.a)(r,t,[function(){var e=this._self._c;return e("div",{staticClass:"media-library-field__selected__inner__img__edit"},[e("span",[this._v("Edit")])])}],!1,null,null,null);i.default=o.exports}}]);