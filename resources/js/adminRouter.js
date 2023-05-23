import * as Vue from "vue";
import * as VueRouter from "vue-router";
import AdminProfile from "./components/adminDashboard/AdminProfile.vue";
import Home from "./components/adminDashboard/HomeProfile.vue";
import QuestionRequestes from "./components/adminDashboard/QuestionRequestes.vue";
import { h } from "vue";


const routes = [
    { path: "/", component: Home },
    { path: "/question-requestes", component: QuestionRequestes },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
});

const app = Vue.createApp({
    render: () => h(AdminProfile),
});

app.use(router);

app.mount("#profile");