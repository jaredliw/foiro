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
    path: "/student",
    name: "StudentList",
    component: () => import("@/views/StudentList"),
  },
  {
    path: "/judge",
    name: "JudgeList",
    component: () => import("@/views/JudgeList"),
  },
  {
    path: "/school",
    name: "SchoolList",
    component: () => import("@/views/SchoolList"),
  },
  {
    path: "/contest",
    name: "ContestList",
    component: () => import("@/views/ContestList"),
  },
  {
    path: "/contest/student",
    name: "StudentRegistrationList",
    component: () => import("@/views/StudentRegistrationList"),
  },
  {
    path: "/contest/judge",
    name: "JudgeRegistrationList",
    component: () => import("@/views/JudgeRegistrationList"),
  },
  {
    path: "/contest/scoreboard",
    name: "Scoreboard",
    component: () => import("@/views/ScoreBoard"),
  },
  {
    path: "/contest/result",
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
