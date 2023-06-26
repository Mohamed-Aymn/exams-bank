import * as Vue from "vue";
import * as VueRouter from "vue-router";
import { h } from "vue";
import ExamIndex from "./routes/ExamIndex.vue";
import ManageIndex from "./routes/ManageIndex.vue";
import TeacherRequests from "./routes/TeacherRequests.vue";
import QuestionRequestes from "./routes/QuestionRequestes.vue";


const Index = { template:  
    `<router-view>
    </router-view>
` }

const routes = [
    {  
        path: "/manage",
        component: ManageIndex, 
        children:[
            {
                path: 'teachers',
                component: TeacherRequests,
            },
            {
                path: 'questions',
                component: QuestionRequestes,
            }
        ] 
    },
    { 
        path: "/exam:id", 
        component: ExamIndex 
    },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

const app = Vue.createApp({
    render: () => h(Index),
});

app.use(router);

app.mount(".vue-router");