import * as Vue from "vue";
import * as VueRouter from "vue-router";
import { h } from "vue";
import ProfileTemplate from "./routes/ProfileTemplate.vue";
import ProfileSettingsTemplate from "./routes/ProfileSettingsTemplate.vue";
import ExamTemplate from "./routes/ExamTemplate.vue";
import ExamResultTemplate from "./routes/ExamResultTemplate.vue";
import ManageTemplate from "./routes/ManageTemplate.vue";
import TeacherRequests from "./routes/TeacherRequests.vue";
import QuestionRequestes from "./routes/QuestionRequestes.vue";

const IndexTemplate = {
    template: `<router-view>
    </router-view>
`,
};

const routes = [
    {
        path: "/profile",
        component: ProfileTemplate,
    },
    {
        path: "/profile/settings",
        component: ProfileSettingsTemplate,
    },
    {
        path: "/manage",
        component: ManageTemplate,
        children: [
            {
                path: "teachers",
                component: TeacherRequests,
            },
            {
                path: "questions",
                component: QuestionRequestes,
            },
        ],
    },
    {
        path: "/exam",
        component: ExamTemplate,
    },
    {
        path: "/exams/:id/results",
        component: ExamResultTemplate,
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
