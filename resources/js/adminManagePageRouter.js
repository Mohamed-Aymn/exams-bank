import * as Vue from "vue";
import * as VueRouter from "vue-router";
import AdminProfile from "./components/adminManageRoutes/Index.vue";
import TeacherRequests from "./components/adminManageRoutes/TeacherRequests.vue";
import QuestionRequestes from "./components/adminManageRoutes/QuestionRequestes.vue";
import { h } from "vue";


const routes = [
    { path: "/teachers", component: TeacherRequests },
    { path: "/questions", component: QuestionRequestes },
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