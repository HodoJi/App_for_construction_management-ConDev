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
        path: base_path + 'login',
        component: Login
    },
    {
        name: 'detailStaveniska',
        path: base_path + 'detail-staveniska',
        component: DetailStaveniska
    },
    {
        name: 'zoznamSoferov',
        path: base_path + 'zoznam-soferov',
        component: ZoznamSoferov
    },
    {
        name: 'zoznamObjednavok',
        path: base_path + 'zoznam-objednavok',
        component: ZoznamObjednavok
    },
    {
        name: 'zoznamPersonalu',
        path: base_path + 'zoznam-personalu',
        component: ZoznamPersonalu
    },
    { // ↓ Zoznam materiálov na stavenisku ↓
        name: 'zoznamMaterialov',
        path: base_path + 'zoznam-materialov/:id',
        component: ZoznamMaterialov
    },
    /* šablóna:
    {
        name: 'newExample',
        path: base_path + 'new-example',
        component: NewExample
    }
    */
];
