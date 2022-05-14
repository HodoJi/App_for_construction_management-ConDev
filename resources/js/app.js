//: Main Vue 3 JS.

// !!! NEMENIŤ !!!

import {createApp} from "vue";
import {createRouter, createWebHistory} from "vue-router";
import App from "./components/App.vue";
import {routes} from "./routes";
import axios from "axios";
import VueAxios from "vue-axios";
import $ from "jquery";

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

const app = createApp(App);
app.use(router);
app.use(VueAxios, axios);

app.config.globalProperties.$axios = axios;
app.config.globalProperties.$router = router;
app.config.globalProperties.$BASE_PATH = "/TP2-App_for_construction_management/public/";

router.isReady().then(() => {
    setTimeout(function () {
        app.mount("#app")
    }, 130);
});

require('./bootstrap');

// ↓ Router.beforeEach... ↓
router.beforeEach((to, from) => {
    $(document).ready(function () {
        $.LoadingOverlay("show", {
            background: "rgba(255, 255, 255, 1)",
            image: "",
            fade: [0, 200],
            fontawesome: "fas fa-wrench fa-flip-horizontal fa-spin",
            text: "Načítavam...",
            textResizeFactor: 0.2
        });
        setTimeout(function () {
            $.LoadingOverlay("hide");
        }, 350);
    });
    const base_path = "/TP2-App_for_construction_management/public/";

    // Neprihlásený
    if (!window.Laravel.isLoggedin) {
        if (to.path === base_path + 'home') {
            router.push(base_path + 'login');
        }

        if (to.path === base_path) {
            router.push(base_path + 'login');
        }

        if (to.path.includes(base_path + 'detail-staveniska')) {
            router.push(base_path + 'login');
        }

        if (to.path.includes(base_path + 'zoznam-materialov')) {
            router.push(base_path + 'login');
        }
    }

    // Prihlásený
    if (window.Laravel.isLoggedin) {
        const user_role = window.Laravel.user.role_id;
        console.log(user_role)
        if (to.path === base_path + 'login') {
            router.push(base_path);
        }
        // 4=vodic, 3=robotnik, 2=stavbyveduci 1=admin
        if (user_role === 3) {
            if (to.path.includes(base_path + 'zoznam-soferov')
                || to.path.includes(base_path + 'zoznam-objednavok')
                || to.path.includes(base_path + 'zoznam-objednavok')
                || to.path.includes(base_path + 'pridat-zamestnanca')
                || to.path.includes(base_path + 'upravit-zamestnanca')) {
                router.push(base_path + '401')
            }
        }
        if (user_role === 4) {
            if (to.path.includes(base_path + 'zoznam-soferov')
                || to.path.includes(base_path + 'zoznam-materialov')
                || to.path.includes(base_path + 'pridat-zamestnanca')
                || to.path.includes(base_path + 'upravit-zamestnanca')) {
                router.push(base_path + '401')
            }
        }
        if (user_role === 2) {
            if (to.path.includes(base_path + 'pridat-zamestnanca')
                || to.path.includes(base_path + 'upravit-zamestnanca')) {
                router.push(base_path + '401')
            }
        }


        // if (to.path === base_path + 'register')
        // {
        //     router.push(base_path);
        // }
    }

});
