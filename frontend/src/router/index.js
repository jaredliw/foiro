import Vue from "vue";
import VueRouter from "vue-router";
import axios from "axios";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    beforeEnter: (to, from, next) => {
      next({ name: "Login" });
    },
  },
  {
    path: "/login",
    name: "Login",
    component: () => import("@/views/Login"),
    beforeEnter: async (to, from, next) => {
      let destination = await axios
        .get("/api/me")
        .then((response) => {
          return { path: response.data["data"]["url"] };
        })
        .catch(function () {
          return null;
        });

      if (destination === null) {
        next();
      } else {
        next(destination);
      }
    },
  },
  {
    path: "/dashboard",
    name: "Dashboard",
    component: () => import("@/views/Dashboard"),
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
    path: "/contest/scoring",
    name: "Scoring",
    component: () => import("@/views/Scoring"),
  },
  {
    path: "/contest/scoreboard",
    name: "Scoreboard",
    component: () => import("@/views/ScoreBoard"),
  },
  {
    path: "/contest/result",
    name: "Result",
    component: () => import("@/views/Result"),
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
