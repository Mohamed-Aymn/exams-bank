import * as Vue from "vue";
import * as VueRouter from "vue-router";
import ExamPage from "../routes/examRoutes/Index.vue";
import Question from "../routes/examRoutes/Question.vue";
import { h } from "vue";


const routes = [
    { path: "/:id", component: ExamPage },
    // { path: "/:id", component: Question },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
});

const app = Vue.createApp({
    render: () => h(ExamPage),
});

app.use(router);

app.mount("#exam");