(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-13cfd474"],{"4a89":function(t,e,n){!function(e,n){t.exports=n()}(0,(function(){return function(t){function e(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,e),o.l=!0,o.exports}var n={};return e.m=t,e.c=n,e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:r})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="/",e(e.s=9)}([function(t,e){var n=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=n)},function(t,e){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,e,n){t.exports=!n(3)((function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}))},function(t,e){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,e){var n=t.exports={version:"2.5.1"};"number"==typeof __e&&(__e=n)},function(t,e,n){var r=n(6),o=n(7);t.exports=function(t){return r(o(t))}},function(t,e,n){var r=n(30);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,e){t.exports=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t}},function(t,e){var n=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:n)(t)}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.Avatar=void 0;var r=n(10),o=function(t){return t&&t.__esModule?t:{default:t}}(r);e.Avatar=o.default,e.default=o.default},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(12),o=n.n(r),i=n(41),a=n(11),s=a(o.a,i.a,!1,null,null,null);e.default=s.exports},function(t,e){t.exports=function(t,e,n,r,o,i){var a,s=t=t||{},c=typeof t.default;"object"!==c&&"function"!==c||(a=t,s=t.default);var u,l="function"==typeof s?s.options:s;if(e&&(l.render=e.render,l.staticRenderFns=e.staticRenderFns,l._compiled=!0),n&&(l.functional=!0),o&&(l._scopeId=o),i?(u=function(t){t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,t||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},l._ssrRegister=u):r&&(u=r),u){var f=l.functional,d=f?l.render:l.beforeCreate;f?(l._injectStyles=u,l.render=function(t,e){return u.call(e),d(t,e)}):l.beforeCreate=d?[].concat(d,u):[u]}return{esModule:a,exports:s,options:l}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(13),o=function(t){return t&&t.__esModule?t:{default:t}}(r),i=function(t){for(var e=t.split(/[ -]/),n="",r=0;r<e.length;r++)n+=e[r].charAt(0);return n.length>3&&-1!==n.search(/[A-Z]/)&&(n=n.replace(/[a-z]+/g,"")),n.substr(0,3).toUpperCase()};e.default={name:"avatar",props:{username:{type:String},initials:{type:String},backgroundColor:{type:String},color:{type:String},customStyle:{type:Object},inline:{type:Boolean},size:{type:Number,default:50},src:{type:String},rounded:{type:Boolean,default:!0},lighten:{type:Number,default:80},parser:{type:Function,default:i,validator:function(t){return"string"==typeof t("John",i)}}},data:function(){return{backgroundColors:["#F44336","#FF4081","#9C27B0","#673AB7","#3F51B5","#2196F3","#03A9F4","#00BCD4","#009688","#4CAF50","#8BC34A","#CDDC39","#FFC107","#FF9800","#FF5722","#795548","#9E9E9E","#607D8B"],imgError:!1}},mounted:function(){this.isImage||this.$emit("avatar-initials",this.username,this.userInitial)},computed:{background:function(){if(!this.isImage)return this.backgroundColor||this.randomBackgroundColor(this.username.length,this.backgroundColors)},fontColor:function(){if(!this.isImage)return this.color||this.lightenColor(this.background,this.lighten)},isImage:function(){return!this.imgError&&Boolean(this.src)},style:function(){var t={display:this.inline?"inline-flex":"flex",width:this.size+"px",height:this.size+"px",borderRadius:this.rounded?"50%":0,lineHeight:this.size+Math.floor(this.size/20)+"px",fontWeight:"bold",alignItems:"center",justifyContent:"center",textAlign:"center",userSelect:"none"},e={background:"transparent url('"+this.src+"') no-repeat scroll 0% 0% / "+this.size+"px "+this.size+"px content-box border-box"},n={backgroundColor:this.background,font:Math.floor(this.size/2.5)+"px/"+this.size+"px Helvetica, Arial, sans-serif",color:this.fontColor},r=this.isImage?e:n;return(0,o.default)(t,r),t},userInitial:function(){return this.isImage?"":this.initials||this.parser(this.username,i)}},methods:{initial:i,onImgError:function(t){this.imgError=!0},randomBackgroundColor:function(t,e){return e[t%e.length]},lightenColor:function(t,e){var n=!1;"#"===t[0]&&(t=t.slice(1),n=!0);var r=parseInt(t,16),o=(r>>16)+e;o>255?o=255:o<0&&(o=0);var i=(r>>8&255)+e;i>255?i=255:i<0&&(i=0);var a=(255&r)+e;return a>255?a=255:a<0&&(a=0),(n?"#":"")+(a|i<<8|o<<16).toString(16)}}}},function(t,e,n){t.exports={default:n(14),__esModule:!0}},function(t,e,n){n(15),t.exports=n(4).Object.assign},function(t,e,n){var r=n(16);r(r.S+r.F,"Object",{assign:n(26)})},function(t,e,n){var r=n(0),o=n(4),i=n(17),a=n(19),s=function(t,e,n){var c,u,l,f=t&s.F,d=t&s.G,p=t&s.S,m=t&s.P,v=t&s.B,h=t&s.W,g=d?o:o[e]||(o[e]={}),y=g.prototype,b=d?r:p?r[e]:(r[e]||{}).prototype;for(c in d&&(n=e),n)(u=!f&&b&&void 0!==b[c])&&c in g||(l=u?b[c]:n[c],g[c]=d&&"function"!=typeof b[c]?n[c]:v&&u?i(l,r):h&&b[c]==l?function(t){var e=function(e,n,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(e);case 2:return new t(e,n)}return new t(e,n,r)}return t.apply(this,arguments)};return e.prototype=t.prototype,e}(l):m&&"function"==typeof l?i(Function.call,l):l,m&&((g.virtual||(g.virtual={}))[c]=l,t&s.R&&y&&!y[c]&&a(y,c,l)))};s.F=1,s.G=2,s.S=4,s.P=8,s.B=16,s.W=32,s.U=64,s.R=128,t.exports=s},function(t,e,n){var r=n(18);t.exports=function(t,e,n){if(r(t),void 0===e)return t;switch(n){case 1:return function(n){return t.call(e,n)};case 2:return function(n,r){return t.call(e,n,r)};case 3:return function(n,r,o){return t.call(e,n,r,o)}}return function(){return t.apply(e,arguments)}}},function(t,e){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,e,n){var r=n(20),o=n(25);t.exports=n(2)?function(t,e,n){return r.f(t,e,o(1,n))}:function(t,e,n){return t[e]=n,t}},function(t,e,n){var r=n(21),o=n(22),i=n(24),a=Object.defineProperty;e.f=n(2)?Object.defineProperty:function(t,e,n){if(r(t),e=i(e,!0),r(n),o)try{return a(t,e,n)}catch(t){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},function(t,e,n){var r=n(1);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,e,n){t.exports=!n(2)&&!n(3)((function(){return 7!=Object.defineProperty(n(23)("div"),"a",{get:function(){return 7}}).a}))},function(t,e,n){var r=n(1),o=n(0).document,i=r(o)&&r(o.createElement);t.exports=function(t){return i?o.createElement(t):{}}},function(t,e,n){var r=n(1);t.exports=function(t,e){if(!r(t))return t;var n,o;if(e&&"function"==typeof(n=t.toString)&&!r(o=n.call(t)))return o;if("function"==typeof(n=t.valueOf)&&!r(o=n.call(t)))return o;if(!e&&"function"==typeof(n=t.toString)&&!r(o=n.call(t)))return o;throw TypeError("Can't convert object to primitive value")}},function(t,e){t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},function(t,e,n){"use strict";var r=n(27),o=n(38),i=n(39),a=n(40),s=n(6),c=Object.assign;t.exports=!c||n(3)((function(){var t={},e={},n=Symbol(),r="abcdefghijklmnopqrst";return t[n]=7,r.split("").forEach((function(t){e[t]=t})),7!=c({},t)[n]||Object.keys(c({},e)).join("")!=r}))?function(t,e){for(var n=a(t),c=arguments.length,u=1,l=o.f,f=i.f;c>u;)for(var d,p=s(arguments[u++]),m=l?r(p).concat(l(p)):r(p),v=m.length,h=0;v>h;)f.call(p,d=m[h++])&&(n[d]=p[d]);return n}:c},function(t,e,n){var r=n(28),o=n(37);t.exports=Object.keys||function(t){return r(t,o)}},function(t,e,n){var r=n(29),o=n(5),i=n(31)(!1),a=n(34)("IE_PROTO");t.exports=function(t,e){var n,s=o(t),c=0,u=[];for(n in s)n!=a&&r(s,n)&&u.push(n);for(;e.length>c;)r(s,n=e[c++])&&(~i(u,n)||u.push(n));return u}},function(t,e){var n={}.hasOwnProperty;t.exports=function(t,e){return n.call(t,e)}},function(t,e){var n={}.toString;t.exports=function(t){return n.call(t).slice(8,-1)}},function(t,e,n){var r=n(5),o=n(32),i=n(33);t.exports=function(t){return function(e,n,a){var s,c=r(e),u=o(c.length),l=i(a,u);if(t&&n!=n){for(;u>l;)if((s=c[l++])!=s)return!0}else for(;u>l;l++)if((t||l in c)&&c[l]===n)return t||l||0;return!t&&-1}}},function(t,e,n){var r=n(8),o=Math.min;t.exports=function(t){return t>0?o(r(t),9007199254740991):0}},function(t,e,n){var r=n(8),o=Math.max,i=Math.min;t.exports=function(t,e){return t=r(t),t<0?o(t+e,0):i(t,e)}},function(t,e,n){var r=n(35)("keys"),o=n(36);t.exports=function(t){return r[t]||(r[t]=o(t))}},function(t,e,n){var r=n(0),o=r["__core-js_shared__"]||(r["__core-js_shared__"]={});t.exports=function(t){return o[t]||(o[t]={})}},function(t,e){var n=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++n+r).toString(36))}},function(t,e){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,e){e.f=Object.getOwnPropertySymbols},function(t,e){e.f={}.propertyIsEnumerable},function(t,e,n){var r=n(7);t.exports=function(t){return Object(r(t))}},function(t,e,n){"use strict";var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vue-avatar--wrapper",style:[t.style,t.customStyle],attrs:{"aria-hidden":"true"}},[this.isImage?n("img",{staticStyle:{display:"none"},attrs:{src:this.src},on:{error:t.onImgError}}):t._e(),t._v(" "),n("span",{directives:[{name:"show",rawName:"v-show",value:!this.isImage,expression:"!this.isImage"}]},[t._v(t._s(t.userInitial))])])},o=[],i={render:r,staticRenderFns:o};e.a=i}])}))},7277:function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("page",{attrs:{title:"Papan Pemuka"}},[n("v-col",{staticClass:"mb-4",attrs:{cols:"12"}},[n("h6",{staticClass:"text-h6 font-weight-regular"},[t._v("Maklumat Diri")]),n("p",{staticClass:"caption text--secondary"},[t._v(" Sila menghubungi admin untuk mengemas kini data akaun. ")]),n("v-divider",{staticClass:"mb-3"}),n("v-container",[n("v-row",[n("v-col",{staticClass:"d-flex align-center",attrs:{cols:"3"}},[t._v("Nama Pengguna")]),n("v-col",{attrs:{cols:"7"}},[n("v-text-field",{attrs:{dense:"","hide-details":"",outlined:"",readonly:""},model:{value:t.username,callback:function(e){t.username=e},expression:"username"}})],1)],1),n("v-row",[n("v-col",{staticClass:"d-flex align-center",attrs:{cols:"3"}},[t._v("Nama")]),n("v-col",{attrs:{cols:"7"}},[n("v-text-field",{attrs:{dense:"","hide-details":"",outlined:"",readonly:""},model:{value:t.name,callback:function(e){t.name=e},expression:"name"}})],1)],1),n("v-row",[n("v-col",{staticClass:"d-flex align-center",attrs:{cols:"3"}},[t._v("Peranan")]),n("v-col",{attrs:{cols:"7"}},[n("v-select",{attrs:{items:[t.role],dense:"","hide-details":"",outlined:"",readonly:""},model:{value:t.role,callback:function(e){t.role=e},expression:"role"}})],1)],1),"Pelajar"===t.role?n("v-row",[n("v-col",{staticClass:"d-flex align-center",attrs:{cols:"3"}},[t._v("Sekolah")]),n("v-col",{attrs:{cols:"2"}},[n("v-text-field",{attrs:{dense:"","hide-details":"",outlined:"",readonly:""},model:{value:t.schoolCode,callback:function(e){t.schoolCode=e},expression:"schoolCode"}})],1),n("v-col",{attrs:{cols:"5"}},[n("v-text-field",{attrs:{dense:"","hide-details":"",outlined:"",readonly:""},model:{value:t.schoolName,callback:function(e){t.schoolName=e},expression:"schoolName"}})],1)],1):t._e(),n("v-row",[n("v-col",{staticClass:"d-flex align-center",attrs:{cols:"3"}},[t._v(" Pertandingan Terlibat ")]),n("v-col",{attrs:{cols:"7"}},[n("v-autocomplete",{attrs:{items:t.contests,chips:"",dense:"","hide-details":"",multiple:"",outlined:"",readonly:"","small-chips":""},model:{value:t.contests,callback:function(e){t.contests=e},expression:"contests"}})],1)],1)],1)],1)],1)},o=[],i=(n("b0c0"),n("d81d"),n("9973")),a={name:"Dashboard",components:{Page:i["a"]},data:function(){return{name:"",username:"",role:"",schoolCode:"",schoolName:"",contests:[]}},mounted:function(){var t=this;this.axios.get("/api/me").then((function(e){var n,r;t.username=e.data["data"]["username"],t.name=e.data["data"]["name"],t.role=e.data["data"]["role"],t.contests=e.data["data"]["contests"].map((function(t){return t["name"]})),t.schoolCode=null!==(n=e.data["data"]["school_code"])&&void 0!==n?n:"",t.schoolName=null!==(r=e.data["data"]["school_name"])&&void 0!==r?r:""})).catch((function(){t.fireErrorToast("Data akaun tidak dapat dimuatkan.")}))}},s=a,c=n("2877"),u=Object(c["a"])(s,r,o,!1,null,null,null);e["default"]=u.exports},"876a":function(t,e,n){},9973:function(t,e,n){"use strict";var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-container",{staticClass:"pa-0",attrs:{"fill-height":"",fluid:""}},[n("sidebar",{ref:"sidebar",attrs:{id:"sidebar"}}),n("v-container",{class:t.$vuetify.breakpoint.smOnly?"pa-3 align-content-start":"align-content-start",attrs:{id:"main","fill-height":""}},[n("v-row",{staticClass:"mb-2 mt-4 align-center"},[n("v-col",{staticClass:"d-flex align-content-center",attrs:{cols:t.noActionBar?12:7,md:t.noActionBar?12:6}},[t.$vuetify.breakpoint.mdAndDown?n("v-btn",{attrs:{icon:""},on:{click:function(e){return e.stopPropagation(),t.$refs.sidebar.triggerOpen()}}},[n("v-icon",[t._v("mdi-menu")])],1):t._e(),n("h5",{staticClass:"text-h5 font-weight-medium text-truncate align-self-center"},[t._v(" "+t._s(t.title)+" ")])],1),t.noActionBar?t._e():n("v-col",{attrs:{cols:"5",md:6}},[n("div",{staticClass:"d-flex justify-end"},[t._t("action-bar")],2)])],1),t._t("default")],2)],1)},o=[],i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-navigation-drawer",{attrs:{"expand-on-hover":t.$vuetify.breakpoint.mdAndUp,permanent:t.$vuetify.breakpoint.mdAndUp,temporary:t.$vuetify.breakpoint.smAndDown,absolute:t.$vuetify.breakpoint.smAndDown},model:{value:t.state,callback:function(e){t.state=e},expression:"state"}},[n("v-list",[n("v-list-item",{staticClass:"px-2"},[n("v-list-item-avatar",{staticClass:"my-1"},[n("avatar",{attrs:{size:40,username:t.myName}})],1),n("v-list-item-content",{staticClass:"py-1"},[n("v-list-item-title",{staticClass:"text-h6"},[t._v(" "+t._s(t.myName)+" ")]),n("v-list-item-subtitle",[t._v(t._s(t.myUsername))])],1),n("v-list-item-action",{staticClass:"my-1",on:{click:function(e){return t.logout()}}},[n("v-btn",{attrs:{icon:""}},[n("v-icon",{attrs:{color:"error"}},[t._v("mdi-logout")])],1)],1)],1)],1),n("v-divider"),n("v-list",{attrs:{dense:"",nav:""}},[n("v-list-item-group",{attrs:{mandatory:""}},[n("v-list-item",{staticClass:"d-none"}),t._l(t.navItems.filter((function(e){return e.accessibleBy.includes(t.myRole)})),(function(e){return[e.children?n("v-list-group",{key:e.text,attrs:{"prepend-icon":e.icon},scopedSlots:t._u([{key:"activator",fn:function(){return[n("v-list-item-content",[n("v-list-item-title",[t._v(t._s(e.text))])],1)]},proxy:!0}],null,!0)},t._l(e.children.filter((function(e){return e.accessibleBy.includes(t.myRole)})),(function(e){return n("v-list-item",{key:e.text,attrs:{href:e.href,link:""}},[n("v-list-item-icon",[n("v-icon",[t._v(t._s(e.icon))])],1),n("v-list-item-title",[t._v(t._s(e.text))])],1)})),1):n("v-list-item",{key:e.text,attrs:{href:e.href}},[n("v-list-item-icon",[n("v-icon",[t._v(t._s(e.icon))])],1),n("v-list-item-title",[t._v(t._s(e.text))])],1)]}))],2)],1)],1)},a=[],s=(n("b0c0"),n("4a89")),c=n.n(s),u={name:"Sidebar",components:{Avatar:c.a},data:function(){return{state:!1,myName:"",myUsername:"",myRole:"",navItems:[{icon:"mdi-account-details-outline",text:"Maklumat Diri",href:"/dashboard",accessibleBy:["Pelajar","Hakim"]},{icon:"mdi-account-school-outline",text:"Pelajar",href:"/student",accessibleBy:["Admin"]},{icon:"mdi-account-tie-hat-outline",text:"Hakim",href:"/judge",accessibleBy:["Admin"]},{icon:"mdi-town-hall",text:"Sekolah",href:"/school",accessibleBy:["Admin"]},{icon:"mdi-calendar-star",text:"Pertandingan",accessibleBy:["Pelajar","Hakim","Admin"],children:[{icon:"mdi-newspaper",text:"Acara",href:"/contest",accessibleBy:["Admin"]},{icon:"mdi-badge-account-horizontal-outline",text:"Pendaftaran Pelajar",href:"/contest/student",accessibleBy:["Admin"]},{icon:"mdi-ballot-outline",text:"Pendaftaran Hakim",href:"/contest/judge",accessibleBy:["Admin"]},{icon:"mdi-counter",text:"Pemarkahan",href:"/contest/scoring",accessibleBy:["Hakim"]},{icon:"mdi-counter",text:"Papan Markah",href:"/contest/scoreboard",accessibleBy:["Admin"]},{icon:"mdi-note-search-outline",text:"Keputusan",href:"/contest/result",accessibleBy:["Pelajar","Hakim","Admin"]}]}]}},methods:{triggerOpen:function(){this.state=!0},getUserInfo:function(){var t=this;this.axios.get("/api/me").then((function(e){t.myUsername=e.data["data"]["username"],t.myName=e.data["data"]["name"],t.myRole=e.data["data"]["role"]})).catch((function(){t.fireErrorToast("Data akaun tidak dapat dimuatkan.")}))},logout:function(){var t=this;this.axios.get("/api/logout").then((function(){t.$router.push("/login")})).catch((function(){t.fireErrorToast()}))}},mounted:function(){this.getUserInfo()}},l=u,f=n("2877"),d=Object(f["a"])(l,i,a,!1,null,null,null),p=d.exports,m={name:"Page",components:{Sidebar:p},props:{title:{type:String,required:!0},noActionBar:{type:Boolean,default:!1}},metaInfo:function(){return{title:this.title}},data:function(){return{navigationDrawer:!1}}},v=m,h=(n("ce7c"),Object(f["a"])(v,r,o,!1,null,"3153b91d",null));e["a"]=h.exports},ce7c:function(t,e,n){"use strict";n("876a")},d81d:function(t,e,n){"use strict";var r=n("23e7"),o=n("b727").map,i=n("1dde"),a=i("map");r({target:"Array",proto:!0,forced:!a},{map:function(t){return o(this,t,arguments.length>1?arguments[1]:void 0)}})}}]);
//# sourceMappingURL=chunk-13cfd474.ed6cac44.js.map