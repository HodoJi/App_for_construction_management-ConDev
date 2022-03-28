import Home from "./components/Home.vue";

const base_path = "/TP2-App_for_construction_management/public/";

export const routes = [{
        name: 'home',
        path: base_path,
        component: Home
    },
    /* šablóna:
    {
        name: 'newexample',
        path: base_path + name,
        component: NewExample
    }
    */
];
