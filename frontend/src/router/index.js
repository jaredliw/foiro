import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Login",
    component: () => import("@/views/Login"),
  },
  {
    path: "/admin/student",
    name: "Student",
    component: () => import("@/views/StudentList"),
  },
  {
    path: "/admin/school",
    name: "SchoolList",
    component: () => import("@/views/SchoolList"),
  },
  {
    path: "/admin/contest",
    name: "ContestList",
    component: () => import("@/views/ContestList"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
