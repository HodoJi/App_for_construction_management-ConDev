//: Main Vue 3 JS.

// !!! NEMENIŤ !!!

import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";
import { routes } from "./routes";
import axios from "axios";
import VueAxios from "vue-axios";
import Header from "./components/Header";
import Footer from "./components/Footer";

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

const app = createApp(App);
app.component('Header', Header);
app.component('Footer', Footer);
app.use(router);
app.use(VueAxios, axios);

app.config.globalProperties.$axios = axios;
app.config.globalProperties.$router = router;

router.isReady().then(() => app.mount("#app"));

require('./bootstrap');


// ↓ Router.beforeEach... ↓
router.beforeEach((to, from) => {
    const base_path = "/TP2-App_for_construction_management/public/";

/* Neprihlásený
    if (!window.Laravel.isLoggedin)
    {
        if (to.path === base_path + 'home')
        {
            router.push(base_path + 'login');
        }

        if (to.path === base_path)
        {
            router.push(base_path + 'login');
        }
    }

// Prihlásený
    if (window.Laravel.isLoggedin)
    {
        if (to.path === base_path + 'login')
        {
            router.push(base_path);
        }

        if (to.path === base_path + 'register')
        {
            router.push(base_path);
        }
    }*/
});
