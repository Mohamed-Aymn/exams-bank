import * as Vue from "vue";
import * as VueRouter from "vue-router";
import AdminProfile from "./components/adminDashboard/Index.vue";
import Home from "./components/adminDashboard/HomeProfile.vue";
import QuestionRequestes from "./components/adminDashboard/QuestionRequestes.vue";
import { h } from "vue";


const routes = [
    { path: "/questions", component: Home },
    { path: "/teachers", component: QuestionRequestes },
    // { path: "/feedback", component: QuestionRequestes },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
});

const app = Vue.createApp({
    render: () => h(AdminProfile),
});

// const app = Vue.createApp({})

app.use(router);

app.mount("#admin_manage");