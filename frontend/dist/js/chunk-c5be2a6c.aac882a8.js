(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-c5be2a6c"],{"0632":function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("page",{attrs:{title:"Pemarkahan"}},[n("v-row",[n("v-col",{attrs:{cols:"12"}},[n("contest-selector",{model:{value:t.contest,callback:function(e){t.contest=e},expression:"contest"}})],1)],1),n("v-row",[n("v-col",{attrs:{cols:"12"}},[n("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[n("thead",[n("tr",[n("th",{staticClass:"text-left"},[t._v("Nama Pengguna")]),n("th",{staticClass:"text-left"},[t._v("Nama")]),n("th",{staticClass:"text-left",staticStyle:{"max-width":"3ch"}},[t._v("Markah")])])]),n("tbody",t._l(t.students,(function(e){return n("tr",{key:e.username},[n("td",[t._v(t._s(e.student_username))]),n("td",[t._v(t._s(e.student_name))]),n("td",{staticStyle:{"max-width":"3ch"}},[n("v-text-field",{staticClass:"pb-3 pt-2 mb-1",attrs:{"hide-details":"",min:"0",type:"number"},model:{value:e.score,callback:function(n){t.$set(e,"score",n)},expression:"item.score"}})],1)])})),0)]},proxy:!0}])})],1)],1),n("v-row",[n("v-col",{staticClass:"d-flex justify-end",attrs:{cols:"12"}},[n("v-btn",{staticClass:"darken-1",attrs:{color:"success"},on:{click:t.save}},[n("span",{staticClass:"text-uppercase"},[t._v("SIMPAN")]),n("v-icon",{attrs:{right:""}},[t._v("mdi-content-save")])],1)],1)],1)],1)},i=[],o=n("c7eb"),a=n("1da1"),s=n("9973"),c=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-select",{staticClass:"px-6",attrs:{items:t.contests,label:"Pertandingan","no-data-text":"Tiada rekod."},model:{value:t.contest,callback:function(e){t.contest=e},expression:"contest"}})},u=[],l=(n("d81d"),n("b0c0"),{name:"ContestSelector",data:function(){return{contest:null,contests:null}},watch:{contest:function(){this.$emit("input",this.contest)}},mounted:function(){var t=this;return Object(a["a"])(Object(o["a"])().mark((function e(){var n;return Object(o["a"])().wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.axios.get("/api/contest").then((function(t){return t.data["data"].map((function(t){return{text:t["name"],value:t["id"]}}))})).catch((function(e){t.fireErrorToast(e.response.data["message"])}));case 2:t.contests=e.sent,t.contest=null===(n=t.contests[0])||void 0===n?void 0:n.value;case 4:case"end":return e.stop()}}),e)})))()}}),f=l,d=n("2877"),p=Object(d["a"])(f,c,u,!1,null,null,null),m=p.exports,h={name:"Scoring",components:{Page:s["a"],ContestSelector:m},data:function(){return{contest:null,students:[]}},watch:{contest:function(){var t=this;return Object(a["a"])(Object(o["a"])().mark((function e(){return Object(o["a"])().wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.axios.get("/api/contest/scoring",{params:{contest_id:t.contest}}).then((function(t){return t.data["data"]})).catch((function(e){t.fireErrorToast(e.response.data["message"])}));case 2:t.students=e.sent;case 3:case"end":return e.stop()}}),e)})))()}},methods:{save:function(){var t=this;this.axios.put("/api/contest/scoring",{contest_id:this.contest,records:this.students}).then((function(e){t.fireSuccessToast(e.data["message"])})).catch((function(e){t.fireErrorToast(e.response.data["message"])}))}}},v=h,y=Object(d["a"])(v,r,i,!1,null,null,null);e["default"]=y.exports},"4a89":function(t,e,n){!function(e,n){t.exports=n()}(0,(function(){return function(t){function e(r){if(n[r])return n[r].exports;var i=n[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,e),i.l=!0,i.exports}var n={};return e.m=t,e.c=n,e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:r})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="/",e(e.s=9)}([function(t,e){var n=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=n)},function(t,e){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,e,n){t.exports=!n(3)((function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}))},function(t,e){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,e){var n=t.exports={version:"2.5.1"};"number"==typeof __e&&(__e=n)},function(t,e,n){var r=n(6),i=n(7);t.exports=function(t){return r(i(t))}},function(t,e,n){var r=n(30);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,e){t.exports=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t}},function(t,e){var n=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:n)(t)}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.Avatar=void 0;var r=n(10),i=function(t){return t&&t.__esModule?t:{default:t}}(r);e.Avatar=i.default,e.default=i.default},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(12),i=n.n(r),o=n(41),a=n(11),s=a(i.a,o.a,!1,null,null,null);e.default=s.exports},function(t,e){t.exports=function(t,e,n,r,i,o){var a,s=t=t||{},c=typeof t.default;"object"!==c&&"function"!==c||(a=t,s=t.default);var u,l="function"==typeof s?s.options:s;if(e&&(l.render=e.render,l.staticRenderFns=e.staticRenderFns,l._compiled=!0),n&&(l.functional=!0),i&&(l._scopeId=i),o?(u=function(t){t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,t||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},l._ssrRegister=u):r&&(u=r),u){var f=l.functional,d=f?l.render:l.beforeCreate;f?(l._injectStyles=u,l.render=function(t,e){return u.call(e),d(t,e)}):l.beforeCreate=d?[].concat(d,u):[u]}return{esModule:a,exports:s,options:l}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(13),i=function(t){return t&&t.__esModule?t:{default:t}}(r),o=function(t){for(var e=t.split(/[ -]/),n="",r=0;r<e.length;r++)n+=e[r].charAt(0);return n.length>3&&-1!==n.search(/[A-Z]/)&&(n=n.replace(/[a-z]+/g,"")),n.substr(0,3).toUpperCase()};e.default={name:"avatar",props:{username:{type:String},initials:{type:String},backgroundColor:{type:String},color:{type:String},customStyle:{type:Object},inline:{type:Boolean},size:{type:Number,default:50},src:{type:String},rounded:{type:Boolean,default:!0},lighten:{type:Number,default:80},parser:{type:Function,default:o,validator:function(t){return"string"==typeof t("John",o)}}},data:function(){return{backgroundColors:["#F44336","#FF4081","#9C27B0","#673AB7","#3F51B5","#2196F3","#03A9F4","#00BCD4","#009688","#4CAF50","#8BC34A","#CDDC39","#FFC107","#FF9800","#FF5722","#795548","#9E9E9E","#607D8B"],imgError:!1}},mounted:function(){this.isImage||this.$emit("avatar-initials",this.username,this.userInitial)},computed:{background:function(){if(!this.isImage)return this.backgroundColor||this.randomBackgroundColor(this.username.length,this.backgroundColors)},fontColor:function(){if(!this.isImage)return this.color||this.lightenColor(this.background,this.lighten)},isImage:function(){return!this.imgError&&Boolean(this.src)},style:function(){var t={display:this.inline?"inline-flex":"flex",width:this.size+"px",height:this.size+"px",borderRadius:this.rounded?"50%":0,lineHeight:this.size+Math.floor(this.size/20)+"px",fontWeight:"bold",alignItems:"center",justifyContent:"center",textAlign:"center",userSelect:"none"},e={background:"transparent url('"+this.src+"') no-repeat scroll 0% 0% / "+this.size+"px "+this.size+"px content-box border-box"},n={backgroundColor:this.background,font:Math.floor(this.size/2.5)+"px/"+this.size+"px Helvetica, Arial, sans-serif",color:this.fontColor},r=this.isImage?e:n;return(0,i.default)(t,r),t},userInitial:function(){return this.isImage?"":this.initials||this.parser(this.username,o)}},methods:{initial:o,onImgError:function(t){this.imgError=!0},randomBackgroundColor:function(t,e){return e[t%e.length]},lightenColor:function(t,e){var n=!1;"#"===t[0]&&(t=t.slice(1),n=!0);var r=parseInt(t,16),i=(r>>16)+e;i>255?i=255:i<0&&(i=0);var o=(r>>8&255)+e;o>255?o=255:o<0&&(o=0);var a=(255&r)+e;return a>255?a=255:a<0&&(a=0),(n?"#":"")+(a|o<<8|i<<16).toString(16)}}}},function(t,e,n){t.exports={default:n(14),__esModule:!0}},function(t,e,n){n(15),t.exports=n(4).Object.assign},function(t,e,n){var r=n(16);r(r.S+r.F,"Object",{assign:n(26)})},function(t,e,n){var r=n(0),i=n(4),o=n(17),a=n(19),s=function(t,e,n){var c,u,l,f=t&s.F,d=t&s.G,p=t&s.S,m=t&s.P,h=t&s.B,v=t&s.W,y=d?i:i[e]||(i[e]={}),g=y.prototype,b=d?r:p?r[e]:(r[e]||{}).prototype;for(c in d&&(n=e),n)(u=!f&&b&&void 0!==b[c])&&c in y||(l=u?b[c]:n[c],y[c]=d&&"function"!=typeof b[c]?n[c]:h&&u?o(l,r):v&&b[c]==l?function(t){var e=function(e,n,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(e);case 2:return new t(e,n)}return new t(e,n,r)}return t.apply(this,arguments)};return e.prototype=t.prototype,e}(l):m&&"function"==typeof l?o(Function.call,l):l,m&&((y.virtual||(y.virtual={}))[c]=l,t&s.R&&g&&!g[c]&&a(g,c,l)))};s.F=1,s.G=2,s.S=4,s.P=8,s.B=16,s.W=32,s.U=64,s.R=128,t.exports=s},function(t,e,n){var r=n(18);t.exports=function(t,e,n){if(r(t),void 0===e)return t;switch(n){case 1:return function(n){return t.call(e,n)};case 2:return function(n,r){return t.call(e,n,r)};case 3:return function(n,r,i){return t.call(e,n,r,i)}}return function(){return t.apply(e,arguments)}}},function(t,e){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,e,n){var r=n(20),i=n(25);t.exports=n(2)?function(t,e,n){return r.f(t,e,i(1,n))}:function(t,e,n){return t[e]=n,t}},function(t,e,n){var r=n(21),i=n(22),o=n(24),a=Object.defineProperty;e.f=n(2)?Object.defineProperty:function(t,e,n){if(r(t),e=o(e,!0),r(n),i)try{return a(t,e,n)}catch(t){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},function(t,e,n){var r=n(1);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,e,n){t.exports=!n(2)&&!n(3)((function(){return 7!=Object.defineProperty(n(23)("div"),"a",{get:function(){return 7}}).a}))},function(t,e,n){var r=n(1),i=n(0).document,o=r(i)&&r(i.createElement);t.exports=function(t){return o?i.createElement(t):{}}},function(t,e,n){var r=n(1);t.exports=function(t,e){if(!r(t))return t;var n,i;if(e&&"function"==typeof(n=t.toString)&&!r(i=n.call(t)))return i;if("function"==typeof(n=t.valueOf)&&!r(i=n.call(t)))return i;if(!e&&"function"==typeof(n=t.toString)&&!r(i=n.call(t)))return i;throw TypeError("Can't convert object to primitive value")}},function(t,e){t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},function(t,e,n){"use strict";var r=n(27),i=n(38),o=n(39),a=n(40),s=n(6),c=Object.assign;t.exports=!c||n(3)((function(){var t={},e={},n=Symbol(),r="abcdefghijklmnopqrst";return t[n]=7,r.split("").forEach((function(t){e[t]=t})),7!=c({},t)[n]||Object.keys(c({},e)).join("")!=r}))?function(t,e){for(var n=a(t),c=arguments.length,u=1,l=i.f,f=o.f;c>u;)for(var d,p=s(arguments[u++]),m=l?r(p).concat(l(p)):r(p),h=m.length,v=0;h>v;)f.call(p,d=m[v++])&&(n[d]=p[d]);return n}:c},function(t,e,n){var r=n(28),i=n(37);t.exports=Object.keys||function(t){return r(t,i)}},function(t,e,n){var r=n(29),i=n(5),o=n(31)(!1),a=n(34)("IE_PROTO");t.exports=function(t,e){var n,s=i(t),c=0,u=[];for(n in s)n!=a&&r(s,n)&&u.push(n);for(;e.length>c;)r(s,n=e[c++])&&(~o(u,n)||u.push(n));return u}},function(t,e){var n={}.hasOwnProperty;t.exports=function(t,e){return n.call(t,e)}},function(t,e){var n={}.toString;t.exports=function(t){return n.call(t).slice(8,-1)}},function(t,e,n){var r=n(5),i=n(32),o=n(33);t.exports=function(t){return function(e,n,a){var s,c=r(e),u=i(c.length),l=o(a,u);if(t&&n!=n){for(;u>l;)if((s=c[l++])!=s)return!0}else for(;u>l;l++)if((t||l in c)&&c[l]===n)return t||l||0;return!t&&-1}}},function(t,e,n){var r=n(8),i=Math.min;t.exports=function(t){return t>0?i(r(t),9007199254740991):0}},function(t,e,n){var r=n(8),i=Math.max,o=Math.min;t.exports=function(t,e){return t=r(t),t<0?i(t+e,0):o(t,e)}},function(t,e,n){var r=n(35)("keys"),i=n(36);t.exports=function(t){return r[t]||(r[t]=i(t))}},function(t,e,n){var r=n(0),i=r["__core-js_shared__"]||(r["__core-js_shared__"]={});t.exports=function(t){return i[t]||(i[t]={})}},function(t,e){var n=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++n+r).toString(36))}},function(t,e){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,e){e.f=Object.getOwnPropertySymbols},function(t,e){e.f={}.propertyIsEnumerable},function(t,e,n){var r=n(7);t.exports=function(t){return Object(r(t))}},function(t,e,n){"use strict";var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vue-avatar--wrapper",style:[t.style,t.customStyle],attrs:{"aria-hidden":"true"}},[this.isImage?n("img",{staticStyle:{display:"none"},attrs:{src:this.src},on:{error:t.onImgError}}):t._e(),t._v(" "),n("span",{directives:[{name:"show",rawName:"v-show",value:!this.isImage,expression:"!this.isImage"}]},[t._v(t._s(t.userInitial))])])},i=[],o={render:r,staticRenderFns:i};e.a=o}])}))},"876a":function(t,e,n){},9973:function(t,e,n){"use strict";var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-container",{staticClass:"pa-0",attrs:{"fill-height":"",fluid:""}},[n("sidebar",{ref:"sidebar",attrs:{id:"sidebar"}}),n("v-container",{class:t.$vuetify.breakpoint.smOnly?"pa-3 align-content-start":"align-content-start",attrs:{id:"main","fill-height":""}},[n("v-row",{staticClass:"mb-2 mt-4 align-center"},[n("v-col",{staticClass:"d-flex align-content-center",attrs:{cols:t.noActionBar?12:7,md:t.noActionBar?12:6}},[t.$vuetify.breakpoint.mdAndDown?n("v-btn",{attrs:{icon:""},on:{click:function(e){return e.stopPropagation(),t.$refs.sidebar.triggerOpen()}}},[n("v-icon",[t._v("mdi-menu")])],1):t._e(),n("h5",{staticClass:"text-h5 font-weight-medium text-truncate align-self-center"},[t._v(" "+t._s(t.title)+" ")])],1),t.noActionBar?t._e():n("v-col",{attrs:{cols:"5",md:6}},[n("div",{staticClass:"d-flex justify-end"},[t._t("action-bar")],2)])],1),t._t("default")],2)],1)},i=[],o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-navigation-drawer",{attrs:{"expand-on-hover":t.$vuetify.breakpoint.mdAndUp,permanent:t.$vuetify.breakpoint.mdAndUp,temporary:t.$vuetify.breakpoint.smAndDown,absolute:t.$vuetify.breakpoint.smAndDown},model:{value:t.state,callback:function(e){t.state=e},expression:"state"}},[n("v-list",[n("v-list-item",{staticClass:"px-2"},[n("v-list-item-avatar",{staticClass:"my-1"},[n("avatar",{attrs:{size:40,username:t.myName}})],1),n("v-list-item-content",{staticClass:"py-1"},[n("v-list-item-title",{staticClass:"text-h6"},[t._v(" "+t._s(t.myName)+" ")]),n("v-list-item-subtitle",[t._v(t._s(t.myUsername))])],1),n("v-list-item-action",{staticClass:"my-1",on:{click:function(e){return t.logout()}}},[n("v-btn",{attrs:{icon:""}},[n("v-icon",{attrs:{color:"error"}},[t._v("mdi-logout")])],1)],1)],1)],1),n("v-divider"),n("v-list",{attrs:{dense:"",nav:""}},[n("v-list-item-group",{attrs:{mandatory:""}},[n("v-list-item",{staticClass:"d-none"}),t._l(t.navItems.filter((function(e){return e.accessibleBy.includes(t.myRole)})),(function(e){return[e.children?n("v-list-group",{key:e.text,attrs:{"prepend-icon":e.icon},scopedSlots:t._u([{key:"activator",fn:function(){return[n("v-list-item-content",[n("v-list-item-title",[t._v(t._s(e.text))])],1)]},proxy:!0}],null,!0)},t._l(e.children.filter((function(e){return e.accessibleBy.includes(t.myRole)})),(function(e){return n("v-list-item",{key:e.text,attrs:{href:e.href,link:""}},[n("v-list-item-icon",[n("v-icon",[t._v(t._s(e.icon))])],1),n("v-list-item-title",[t._v(t._s(e.text))])],1)})),1):n("v-list-item",{key:e.text,attrs:{href:e.href}},[n("v-list-item-icon",[n("v-icon",[t._v(t._s(e.icon))])],1),n("v-list-item-title",[t._v(t._s(e.text))])],1)]}))],2)],1)],1)},a=[],s=(n("b0c0"),n("4a89")),c=n.n(s),u={name:"Sidebar",components:{Avatar:c.a},data:function(){return{state:!1,myName:"",myUsername:"",myRole:"",navItems:[{icon:"mdi-account-details-outline",text:"Maklumat Diri",href:"/dashboard",accessibleBy:["Pelajar","Hakim"]},{icon:"mdi-account-school-outline",text:"Pelajar",href:"/student",accessibleBy:["Admin"]},{icon:"mdi-account-tie-hat-outline",text:"Hakim",href:"/judge",accessibleBy:["Admin"]},{icon:"mdi-town-hall",text:"Sekolah",href:"/school",accessibleBy:["Admin"]},{icon:"mdi-calendar-star",text:"Pertandingan",accessibleBy:["Pelajar","Hakim","Admin"],children:[{icon:"mdi-newspaper",text:"Acara",href:"/contest",accessibleBy:["Admin"]},{icon:"mdi-badge-account-horizontal-outline",text:"Pendaftaran Pelajar",href:"/contest/student",accessibleBy:["Admin"]},{icon:"mdi-ballot-outline",text:"Pendaftaran Hakim",href:"/contest/judge",accessibleBy:["Admin"]},{icon:"mdi-counter",text:"Pemarkahan",href:"/contest/scoring",accessibleBy:["Hakim"]},{icon:"mdi-counter",text:"Papan Markah",href:"/contest/scoreboard",accessibleBy:["Admin"]},{icon:"mdi-note-search-outline",text:"Keputusan",href:"/contest/result",accessibleBy:["Pelajar","Hakim","Admin"]}]}]}},methods:{triggerOpen:function(){this.state=!0},getUserInfo:function(){var t=this;this.axios.get("/api/me").then((function(e){t.myUsername=e.data["data"]["username"],t.myName=e.data["data"]["name"],t.myRole=e.data["data"]["role"]})).catch((function(){t.fireErrorToast("Data akaun tidak dapat dimuatkan.")}))},logout:function(){var t=this;this.axios.get("/api/logout").then((function(){t.$router.push("/login")})).catch((function(){t.fireErrorToast()}))}},mounted:function(){this.getUserInfo()}},l=u,f=n("2877"),d=Object(f["a"])(l,o,a,!1,null,null,null),p=d.exports,m={name:"Page",components:{Sidebar:p},props:{title:{type:String,required:!0},noActionBar:{type:Boolean,default:!1}},metaInfo:function(){return{title:this.title}},data:function(){return{navigationDrawer:!1}}},h=m,v=(n("ce7c"),Object(f["a"])(h,r,i,!1,null,"3153b91d",null));e["a"]=v.exports},ce7c:function(t,e,n){"use strict";n("876a")},d81d:function(t,e,n){"use strict";var r=n("23e7"),i=n("b727").map,o=n("1dde"),a=o("map");r({target:"Array",proto:!0,forced:!a},{map:function(t){return i(this,t,arguments.length>1?arguments[1]:void 0)}})}}]);
//# sourceMappingURL=chunk-c5be2a6c.aac882a8.js.map