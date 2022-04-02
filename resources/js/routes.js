import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import DetailStaveniska from "./components/DetailStaveniska";
import ZoznamSoferov from "./components/ZoznamSoferov";
import ZoznamObjednavok from "./components/ZoznamObjednavok";
import ZoznamPersonalu from "./components/ZoznamPersonalu";
import ZoznamMaterialov from "./components/ZoznamMaterialov";

const base_path = "/TP2-App_for_construction_management/public/";

export const routes = [{
        name: 'home',
        path: base_path,
        component: Home
    },
    {
        name: 'login',
        path: base_path +'login',
        component: Login
    },
    {
        name: 'detailstaveniska',
        path: base_path +'detailstaveniska',
        component: DetailStaveniska
    },
    {
        name: 'zoznamsoferov',
        path: base_path +'zoznamsoferov',
        component: ZoznamSoferov
    },
    {
        name: 'zoznamobjednavok',
        path: base_path +'zoznamobjednavok',
        component: ZoznamObjednavok
    },
    {
        name: 'zoznampersonalu',
        path: base_path +'zoznampersonalu',
        component: ZoznamPersonalu
    },
    {
        name: 'zoznammaterialov',
        path: base_path +'zoznammaterialov',
        component: ZoznamMaterialov
    },
    /* šablóna:
    {
        name: 'newexample',
        path: base_path + name,
        component: NewExample
    }
    */
];
