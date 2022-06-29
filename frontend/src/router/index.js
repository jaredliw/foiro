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
    name: "StudentList",
    component: () => import("@/views/StudentList"),
  },
  {
    path: "/admin/judge",
    name: "JudgeList",
    component: () => import("@/views/JudgeList"),
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
  {
    path: "/admin/contest/student",
    name: "StudentRegistrationList",
    component: () => import("@/views/StudentRegistrationList"),
  },
  {
    path: "/admin/contest/judge",
    name: "JudgeRegistrationList",
    component: () => import("@/views/JudgeRegistrationList"),
  },
  {
    path: "/admin/contest/scoreboard",
    name: "Scoreboard",
    component: () => import("@/views/ScoreBoard"),
  },
  {
    path: "/admin/contest/result",
    name: "ResultList",
    component: () => import("@/views/ResultList"),
  },
  {
    path: "*",
    name: "404",
    component: () => import("@/views/404"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
