(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0d0815"],{"67ec":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("data-page",{ref:"dataPage",attrs:{"get-params-func":t.params,headers:[{text:"Nama Pengguna Pelajar",value:"username"},{text:"Nama Pelajar",value:"name"}],"lazy-load":!0,"no-crud":!0,"no-import-csv":!0,"api-url":"/api/contest/student","item-key":"username",title:"Pendaftaran Pelajar"}},[a("v-select",{staticClass:"px-6",attrs:{items:t.contests,label:"Pertandingan"},model:{value:t.contest,callback:function(e){t.contest=e},expression:"contest"}})],1)},s=[],c=a("c7eb"),r=a("1da1"),o=(a("d81d"),a("b0c0"),a("2696")),u={name:"StudentRegistrationList",components:{DataPage:o["a"]},data:function(){return{contest:null,contests:null}},methods:{params:function(){return{contest_id:this.contest}}},watch:{contest:function(){this.$refs.dataPage.loadAll()}},mounted:function(){var t=this;return Object(r["a"])(Object(c["a"])().mark((function e(){var a;return Object(c["a"])().wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.axios.get("/api/contest").then((function(t){return t.data["data"].map((function(t){return{text:t["name"],value:t["id"]}}))})).catch((function(e){t.fireErrorToast(e.response.data["message"])}));case 2:t.contests=e.sent,t.contest=null===(a=t.contests[0])||void 0===a?void 0:a.value;case 4:case"end":return e.stop()}}),e)})))()}},i=u,l=a("2877"),d=Object(l["a"])(i,n,s,!1,null,null,null);e["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d0d0815.336cce59.js.map