<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam personálu</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">{{ constructionName }} (stavenisko
                            #{{ constructionNumber }})</p>
                    </div>
                </div>

            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-dark"><i class="fas fa-list fs-6"></i></button>
            </div>
        </div>
        <form class="border border-dark rounded opacity-75 p-3 mb-5" v-if="role_id <= 2">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Vyhľadávanie podľa mena</label>
                        <input class="form-control form-control-lg" id="inputName" type="text" @keyup="findUsers" v-model="employeeName" placeholder="" aria-label=".form-control-lg example">
                        <div id="nameHelp" class="form-text">Zadaj celé alebo čiastočné meno zamestnanca</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12" v-for="employee in searchedWorkers.users" :key="employee.id">
                    <div class="mb-3">
                        <div class="card " :class="{'bg-warning bg-opacity-75' : employee.cID == this.$route.params.id, 'bg-danger bg-opacity-50' : employee.cID == null}">
                            <div class="card-body">
                                <div class="card-header bg-transparent p-0 mb-3 border-0">
                                    <h5 class="card-title fw-bold">{{ employee.name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted small fw-lighter">{{employee.email}}</h6>
                                </div>
                                <p class="card-text small" v-if="employee.cID !== null"><span class="fw-bold">{{ employee.name }}</span> už je priradený/á k stavenisku <span class="fw-bold">{{employee.title}}</span> (#{{employee.cID}})</p>
                                <p class="card-text small" v-if="employee.cID == null"><span class="fw-bold">{{ employee.name }}</span> ešte nie je priradený/á k žiadnemu stavenisku!</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <button type="button" class="btn btn-success float-end" @click="addUserToConstruction(employee.id)"><i class="fas fa-check"></i> Pridať zamestnanca ku stavenisku</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <div class="align-items-center justify-content-center mb-5">
                <h4>Personál</h4>
                <ul class="list-group" v-if="workers.length > 0" v-for="(worker, index) in workers">
                    <li class="list-group-item align-middle">
                        <div class="row g-0 justify-content-center">
                            <div class="col">
                                <button type="button" class="btn btn-dark">{{index + 1}}.</button>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold text-center">{{ worker.name }}</div>
                            </div>

                                <div class="col text-end">
                                    <button type="button" class="btn btn-dark">V práci</button>
                                </div>
                        </div>
                    </li>
                </ul>

            </div>
    </div>

    <Teleport to="body">
        <BurgerMenu :show="showModal" @close="showModal = false" :role_id="role_id">
        </BurgerMenu>
    </Teleport>

</template>

<script>
import Swal from "sweetalert2";
import BurgerMenu from "./BurgerMenu";
import $ from "jquery";

export default {
    name: "ZoznamPersonalu",
    components: {
        BurgerMenu
    },
    data() {
        return {
            employeeName: "",
            role_id: window.Laravel.user.role_id,
            showModal: false,
            workers: [],
            searchedWorkers: [],
            constructionName: "",
            constructionNumber: null
        }
    },
    mounted(){
        this.getConstructionName();
        this.getEmployeeList();
    },
    methods: {
        getConstructionName(){
            this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                this.$axios.get(this.$BASE_PATH + `api/getConstructionDetail/${this.$route.params.id}`)
                    .then(response => {
                        console.log(response.data)
                        this.constructionName = response.data[0].title;
                        this.constructionNumber = response.data[0].id;
                    })
                    .catch(function (error) {
                        console.error(error);
                        Swal.fire({title: "Zoznam robotníkov", html: "Chyba:<br>" + error, icon: "warning"});
                    });
            })
        },
        getEmployeeList () {
            this.workers = []
            this.$nextTick(function () {

                if(this.$route.params.id == null)
                {
                    this.$router.push({name: 'home'})
                }
                else
                {
                    this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                        this.$axios.get(this.$BASE_PATH + `api/construction-workers-show/${this.$route.params.id}`)
                            .then(response => {

                                if (response.data)
                                {
                                    this.workers = response.data

                                    if (this.workers.length > 0)
                                        this.workers.success = true

                                    if (!this.workers.success)
                                    {
                                        Swal.fire({title: "Zoznam robotníkov", html: "Chyba:<br>" + "Žiadny personál nie je na stavenisku.", icon: "warning"});
                                    }
                                }
                                else
                                {
                                    Swal.fire({title: "Zoznam robotníkov", text: "Chyba!", icon: "warning"});
                                }

                            })
                            .catch(function (error) {
                                console.error(error);
                                Swal.fire({title: "Zoznam robotníkov", html: "Chyba:<br>" + error, icon: "warning"});
                            });
                    })
                }
            })
        },
        ChangeArrow(id) {
            console.log($("#"+id).html())
            if ($("#"+id).html() === '<i class="fas fa-angle-down"></i>') {
                $("#"+id).html('<i class="fas fa-angle-up"></i>');
            } else {
                $("#"+id).html('<i class="fas fa-angle-down"></i>');
            }
        },
        addUserToConstruction(id){
            if(id > 0){
                this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                    this.$axios.put(this.$BASE_PATH + `api/construction-assign-employee`, {id:id, constrId:this.$route.params.id})
                        .then(response => {
                            if (response.data)
                            {
                                if (!response.data.success)
                                {

                                    Swal.fire({title: "Personál", html: "Chyba:<br>" + response.data.message, icon: "warning"});
                                } else {
                                    Swal.fire({title: "Personál", html: response.data.message, icon: "success"});
                                }
                                this.findUsers();
                                this.getEmployeeList();
                            }
                            else
                            {
                                Swal.fire({title: "Personál", text: "Chyba!", icon: "warning"});
                            }

                        })
                        .catch(function (error) {
                            console.error(error);
                            Swal.fire({title: "Zoznam robotníkov", html: "Chyba:<br>" + error, icon: "warning"});
                        });
                })
            }
        },
        findUsers(){
            if(this.employeeName.length > 2){
                this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                    this.$axios.post(this.$BASE_PATH + `api/construction-find-employees`, {employeeName:this.employeeName})
                        .then(response => {
                            if (response.data)
                            {
                                this.searchedWorkers = []
                                this.searchedWorkers = response.data

                                if (!this.searchedWorkers.success)
                                {
                                    Swal.fire({title: "Personál", html: "Chyba:<br>" + this.searchedWorkers.message, icon: "warning"});
                                }
                            }
                            else
                            {
                                Swal.fire({title: "Personál", text: "Chyba!", icon: "warning"});
                                this.$router.push({path: this.$BASE_PATH + `detail-staveniska/${this.$route.params.id}`})
                            }

                        })
                        .catch(function (error) {
                            console.error(error);
                            Swal.fire({title: "Zoznam robotníkov", html: "Chyba:<br>" + error, icon: "warning"});
                        });
                })
            } else {
                this.searchedWorkers = []
            }
        }
    }
}
</script>

<style>

</style>
