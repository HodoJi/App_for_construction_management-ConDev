import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import DetailStaveniska from "./components/DetailStaveniska";
import ZoznamSoferov from "./components/ZoznamSoferov";
import ZoznamObjednavok from "./components/ZoznamObjednavok";
import ZoznamPersonalu from "./components/ZoznamPersonalu";
import ZoznamMaterialov from "./components/ZoznamMaterialov";
import e401 from "./components/e401";
import addUser from "./components/addUser";
import editUser from "./components/editUser";

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
        path: base_path + 'detail-staveniska/:id',
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
        path: base_path + 'zoznam-personalu/:id',
        component: ZoznamPersonalu
    },
    { // ↓ Zoznam materiálov na stavenisku ↓
        name: 'zoznamMaterialov',
        path: base_path + 'zoznam-materialov/:id',
        component: ZoznamMaterialov
    },
    {
        name: 'e401',
        path: base_path + '401',
        component: e401
    },
    {
        name: 'addUser',
        path: base_path + 'pridat-zamestnanca',
        component: addUser
    },
    {
        name: 'editUser',
        path: base_path + 'upravit-zamestnanca/:id',
        component: editUser
    },
    /* šablóna:
    {
        name: 'newExample',
        path: base_path + 'new-example',
        component: NewExample
    }
    */
];
