<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam personálu</h4>
                    </div>
                    <!-- <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Tr. A. Hlinku 1 (stavenisko #3)</p>
                    </div> -->
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
                        <input class="form-control form-control-lg" id="inputName" type="text" placeholder="" aria-label=".form-control-lg example">
                        <div id="nameHelp" class="form-text">Zadaj celé alebo čiastočné meno zamestnanca</div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header bg-transparent p-0 mb-3 border-0">
                                    <h5 class="card-title fw-bold">Worker Doe</h5>
                                    <h6 class="card-subtitle mb-2 text-muted small">worderdoe@tp2management.com</h6>
                                </div>
                                <p class="card-text">Worker Doe je práve priradený k stavenisku Tr. A. Hlinku (#1)</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <button type="button" class="btn btn-primary float-end" @click="addUserToConstruction()"><i class="fas fa-check"></i> Pridať zamestnanca ku stavenisku</button>
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
            role_id: window.Laravel.user.role_id,
            showModal: false,
            workers: [],
        }
    },

    mounted: function () {
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
                                    Swal.fire({title: "Zoznam robotníkov", html: "Chyba:<br>" + "Nepodarilo sa nájsť žiadny záznam.", icon: "warning"});
                                    this.$router.push({path: this.$BASE_PATH + `detail-staveniska/${this.$route.params.id}`})
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
    methods: {
        ChangeArrow(id) {
            console.log($("#"+id).html())
            if ($("#"+id).html() === '<i class="fas fa-angle-down"></i>') {
                $("#"+id).html('<i class="fas fa-angle-up"></i>');
            } else {
                $("#"+id).html('<i class="fas fa-angle-down"></i>');
            }
        },
        addUserToConstruction(){

        }
    }
}
</script>

<style>

</style>
