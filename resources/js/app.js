import {createApp} from 'vue'
import ProgressBar from './components/molecules/ProgressBar.vue'

// --------------- laravel bootstrap
import "./bootstrap";

// --------------- jquery
import $ from 'jquery';
window.$ = $;

// --------------- vue client side components
const app = createApp({})

// register each compoent
app.component('progress-bar',ProgressBar)

app.mount("#app")
