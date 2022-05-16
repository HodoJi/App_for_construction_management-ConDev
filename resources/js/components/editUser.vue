<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Upraviť zamestnanca</h4>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-primary"><i
                    class="fas fa-list text-black fs-6"></i></button>
                <button type="button" onclick="history.back()" class="btn btn-primary ms-2"><i class="fas fa-arrow-left fs-6"></i>
                </button>
            </div>
        </div>
        <form class="border border-dark rounded opacity-75 p-3 mb-5">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Meno a priezvisko</label>
                        <input type="text" class="form-control" id="inputName" value="{{employee.name}}">
                        <div id="nameHelp" class="form-text">Zadaj celé meno zamestnanca</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Emailová adresa</label>
                        <input type="email" class="form-control" id="inputEmail" value="{{employee.email}}">
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
                    <button type="button" class="btn btn-primary float-end" @click="editUser()"><i class="fas fa-edit"></i> Uložiť zamestnanca</button>
                </div>
            </div>
        </form>
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
    name: "editUser",
    components: {
        BurgerMenu
    },
    data() {
        return {
            role_id: window.Laravel.user.role_id,
            showModal: false,
            employee: [{name: "Admin Doe", email: "admindoe@tp2management.com", id: "1", role: "admin"}]
        }
    },
    methods: {
        editUser(){

        }
        //
    }
}
</script>

<style>

</style>
