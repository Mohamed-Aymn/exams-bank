import * as Vue from "vue";
import * as VueRouter from "vue-router";
import App from "./components/App.vue";
// import Home from "./Home.vue";
// import About from "./About.vue";
import { h } from "vue";


const routes = [
    // { path: "/", component: Home },
    // { path: "/about", component: About },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
});

const app = Vue.createApp({
    render: () => h(App),
});

app.use(router);

app.mount("#app");