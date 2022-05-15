<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Pridať nového zamestnanca</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Počet zamestnancov: {{ employees.length }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-primary"><i
                    class="fas fa-list text-black fs-6"></i></button>
            </div>
        </div>
        <form class="border border-dark rounded opacity-75 p-3 mb-5">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Meno a priezvisko</label>
                        <input v-model="fields.name" type="text" class="form-control" id="inputName">
                        <div id="nameHelp" class="form-text">Zadaj celé meno zamestnanca</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Emailová adresa</label>
                        <input v-model="fields.email" type="email" class="form-control" id="inputEmail">
                        <div id="emailHelp" class="form-text">Zadaj email zamestnanca</div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="mb-3">
                        <label class="form-label">Pozícia</label>
                        <select class="form-select" id="inputRole">
                            <option value="manager">Stavbyvedúci</option>
                            <option value="driver">Vodič</option>
                            <option value="worker">Robotník</option>
                        </select>
                        <div id="roleHelp" class="form-text">Vyber pozíciu zamestnanca</div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end" @click="addNewUser()"><i class="fas fa-plus"></i> Vytvoriť zamestnanca</button>
                </div>
            </div>
        </form>
        <div class="align-items-center justify-content-center">
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Meno</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rola</th>
                    <th scope="col">Akcia</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(employee, index) in employees">
                    <th scope="row">{{ index + 1 }}.</th>
                    <td class="fw-bold">{{ employee.name }}</td>
                    <td>{{ employee.email }}</td>
                    <td>
                        <span class="btn btn-danger float-end w-100" v-if="employee.role === 'admin'">Správca <i class="fas fa-crown"></i></span>
                        <span class="btn btn-primary float-end w-100" v-if="employee.role === 'manager'">Stavbyvedúci <i class="fas fa-user-tie"></i></span>
                        <span class="btn btn-info float-end w-100" v-if="employee.role === 'driver'">Vodič <i class="fas fa-truck-pickup"></i></span>
                        <span class="btn btn-info float-end w-100" v-if="employee.role === 'worker'">Pracovník <i class="fas fa-hard-hat"></i></span>
                    </td>
                    <td><router-link :to="{ name: `editUser`, params: {id: employee.id} }" class="btn btn-primary float-end" style="text-decoration: none"><i class="fas fa-edit"></i> Upraviť</router-link></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <Teleport to="body">
        <BurgerMenu :show="showModal" @close="showModal = false" :role_id="role_id">
        </BurgerMenu>
    </Teleport>

</template>

<script>

import BurgerMenu from "./BurgerMenu";
import Swal from "sweetalert2";

export default {
    name: "addUser",
    components: {
        BurgerMenu
    },
    data() {
        return {

            fields: {
                name:'',
                email:'',
                personalId:'',
                password:'',
                construction_id:'',
                role_id:''
            },

            role_id: window.Laravel.user.role_id,
            showModal: false,
            employees: [{name: "Admin Doe", email: "admindoe@tp2management.com", id: "1", role: "admin"},
                {name: "Manager Doe", email: "managerdoe@tp2management.com", id: "2", role: "manager"},
                {name: "Driver Doe", email: "driverdoe@tp2management.com", id: "3", role: "driver"},
                {name: "Worker Doe", email: "workerdoe@tp2management.com", id: "4", role: "worker"}]
        }
    },
    methods: {

        addNewUser:function(){
            this.$axios.put(".api/addNewUser",this.fields).then(()=>{
                console.log()
            }).catch(function (error) {
            })
        }


    }
}
</script>

<style>

</style>
