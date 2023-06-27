import * as Vue from "vue";
import * as VueRouter from "vue-router";
import { h } from "vue";
import ProfileTemplate from "./routes/ProfileTemplate.vue";
import ExamTemplate from "./routes/ExamTemplate.vue";
import ManageTemplate from "./routes/ManageTemplate.vue";
import TeacherRequests from "./routes/TeacherRequests.vue";
import QuestionRequestes from "./routes/QuestionRequestes.vue";


const IndexTemplate = { template:  
    `<router-view>
    </router-view>
` }

const routes = [
    {
        path: '/profile',
        component: ProfileTemplate,
    },
    {  
        path: "/manage",
        component: ManageTemplate, 
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
        path: "/exam", 
        component: ExamTemplate ,
        props: route => ({ id: route.query.id })
    },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

const app = Vue.createApp({
    render: () => h(IndexTemplate),
});

app.use(router);

app.mount(".vue-router");