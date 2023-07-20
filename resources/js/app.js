import { createApp } from "vue";
import ProgressBar from "./components/molecules/ProgressBar.vue";
import { createPinia } from "pinia";
// --------------- laravel bootstrap
import "./bootstrap";
import { autoCloseDropdown } from "./globalFunctions";

// --------------- vue configuration
// state management tools
const pinia = createPinia();
// vue app
const app = createApp({});

// register components
app.component("progress-bar", ProgressBar);

// invoke app
app.use(pinia);
app.mount("#app");

// UI global functions
autoCloseDropdown();
