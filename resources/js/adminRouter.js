import * as Vue from "vue";
import * as VueRouter from "vue-router";
import App from "./components/adminComponents/AdminProfile.vue";
import Home from "./components/adminComponents/HomeProfile.vue";
import QuestionRequestes from "./components/adminComponents/QuestionRequestes.vue";
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
    render: () => h(App),
});

app.use(router);

app.mount("#profile");