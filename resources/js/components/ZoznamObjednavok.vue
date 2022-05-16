<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam objednávok</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">{{ constructionName }} (stavenisko
                            #{{ constructionNumber }})</p>
                    </div>
                </div>


            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-dark"><i class="fas fa-list fs-6"></i>
                </button>
                <button type="button" onclick="history.back()" class="btn btn-primary ms-2"><i class="fas fa-arrow-left fs-6"></i>
                </button>
            </div>
        </div>


        <div class="align-items-center justify-content-center">
            <ul class="list-group" v-if="orders.length > 0" v-for="(order, index) in orders ">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">{{ index + 1 }}.</button>
                        </div>
                        <div class="col">
                            <div class="fw-bold text-center">{{ order.materials.material_title }}</div>
                        </div>
                        <div class="col">
                            <div class="fw-lighter text-center">{{ field.amount = order.amount }}ks/kg</div>
                        </div>
                        <div class="col">
                            <div style="visibility: hidden" class="fw-lighter text-center">
                                {{ field.construction_id = order.construction_id }}{{ field.material_id = order.material_id }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="fw-bold text-center">{{ order.statuses.status_name }}</div>
                        </div>
                        <div class="col text-end">
                            <button type="button" v-if="role_id === 4" @click="changeStatus(order.id)"
                                    class="btn btn-success rounded-0 rounded-bottom">Ďalej
                            </button>
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

import $ from "jquery";
import BurgerMenu from "./BurgerMenu";
import Swal from "sweetalert2";

export default {
    name: "ZoznamObjednavok",
    components: {
        BurgerMenu
    },
    data() {
        return {
            showModal: false,
            orders: [],
            constructionName: "",
            constructionNumber: null,

            field: {
                amount: "",
                construction_id: "",
                material_id: "",
                driver_id: window.Laravel.user.id
            },

            role_id: window.Laravel.user.role_id,


        }

    },
    mounted() {
        this.getOrders();
        this.getConstructionName();
    },


    methods: {
        getConstructionName() {
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
        getOrders() {
            this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                this.$axios.get(this.$BASE_PATH + `api/getOrders/${this.$route.params.id}`).then(response => {
                    if (response.data) {
                        this.orders = response.data

                        if (this.orders.length > 0)
                            this.orders.success = true

                        if (!this.orders.success) {
                            Swal.fire({
                                title: "Zoznam objednávok",
                                html: "Chyba:<br>" + "Nepodarilo sa nájsť žiadny záznam.",
                                icon: "warning"
                            });
                            this.$router.push({path: this.$BASE_PATH + `detail-staveniska/${this.$route.params.id}`})
                        }
                    } else {
                        Swal.fire({title: "Zoznam objednávok", text: "Chyba!", icon: "warning"});
                    }
                })
                    .catch(function (error) {
                        console.error(error);
                        Swal.fire({title: "Zoznam objednávok", html: "Chyba:<br>" + error, icon: "warning"});
                    });
            })
        },


        changeStatus(id) {
            this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                this.$axios.post(this.$BASE_PATH + `api/changeStatus/${id}`, this.field).then(response => {
                    if (response.data.success) {
                        Swal.fire({
                            title: "Status objednávky",
                            text: "Status objednávky úspešne zmenený",
                            icon: 'success',
                        }).then(function () {
                            window.location.reload()
                        })
                    } else {
                        this.error = response.data.message


                    }
                })
                    .catch(function (error) {
                        console.error(error);


                    });
            })

        },


    }
}

</script>

<style>

</style>
