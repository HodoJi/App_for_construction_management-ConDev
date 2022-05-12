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

            <div class="align-items-center justify-content-center">
                <h4>Robotníci</h4>

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
        <BurgerMenu :show="showModal" @close="showModal = false">
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

        }
    }
}
</script>

<style>

</style>
