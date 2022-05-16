<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam materiálov</h4>
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

        <div class="row align-items-center justify-content-center mb-5">
            <a id="orderCreateLink" href="#orderCreate" type="button" class="btn btn-dark w-auto" data-bs-toggle="collapse"
               role="button" aria-expanded="false" v-if="role_id <= 2" aria-controls="collapseExample"
               @click="ChangeArrow('orderCreateLink')">Vytvoriť objednávku <i class="fas fa-angle-down ms-2"></i></a>

            <div class="collapse mt-3" id="orderCreate">
                <div class="align-items-center justify-content-center">
                    <form class="border border-dark rounded p-3 mb-5">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="materialArray" class="form-label">Materiál</label>
                                <select class="form-control" v-model="fields.material_id">
                                    <option v-if="materials.length > 0" v-for="(material) in materials"
                                            :value="material.moc_material_id" id="materialArray">
                                        {{ material.material_title + " v " + material.mct_material_counter_type }}
                                    </option>
                                </select>
                                <div id="materialHelp" class="form-text">Napíš materiál, ktorý treba objednať</div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="amountArray" class="form-label">Počet</label>
                                <input v-model="fields.amount" type="number" class="form-control" id="amountArray"
                                       placeholder="Počet">
                                <div id="amountHelp" class="form-text">Zadajte počet ks, kg materiálu</div>
                                <input id="order_create" type="submit" class="btn btn-dark float-end mt-2"
                                       @click="createOrder"
                                       value="Odoslať objednávku">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="align-items-center justify-content-center">
            <ul class="list-group" v-if="materials.length > 0" v-for="(material, index) in materials">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">{{ index + 1 }}.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">{{ material.material_title }}</div>
                        </div>
                        <div class="col text-end">
                            <button type="button" class="btn btn-dark">{{ material.moc_stock_count }}
                                {{ material.mct_material_counter_type }}
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
import Swal from "sweetalert2";
import BurgerMenu from "./BurgerMenu";
import $ from "jquery";

export default {
    name: "ZoznamMaterialov",
    components: {
        BurgerMenu
    },
    data() {
        return {
            role_id: window.Laravel.user.role_id,
            showModal: false,
            materials: [],
            constructionName: "",
            constructionNumber: null,
            fields: {
                material_id: "",
                construction_id: this.$route.params.id,
                amount: ""
            }
        }
    },
    mounted() {
        this.getMaterials();
        this.getConstructionName();
    },
    methods: {
        getMaterials() {
            this.$nextTick(function () {
                if (this.$route.params.id == null) {
                    this.$router.push({name: 'home'})
                } else {
                    this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                        this.$axios.get(this.$BASE_PATH + `api/construction-material-show/${this.$route.params.id}`)
                            .then(response => {

                                if (response.data) {
                                    this.materials = response.data

                                    if (this.materials.length > 0)
                                        this.materials.success = true

                                    if (!this.materials.success) {
                                        Swal.fire({
                                            title: "Zoznam materiálov",
                                            html: "Chyba:<br>" + "Nepodarilo sa nájsť žiadny záznam.",
                                            icon: "warning"
                                        });
                                        this.$router.push({path: this.$BASE_PATH + `detail-staveniska/${this.$route.params.id}`})
                                    }
                                } else {
                                    Swal.fire({title: "Zoznam materiálov", text: "Chyba!", icon: "warning"});
                                }

                            })
                            .catch(function (error) {
                                console.error(error);
                                Swal.fire({title: "Zoznam materiálov", html: "Chyba:<br>" + error, icon: "warning"});
                            });
                    })
                }
            })
        },
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
                        Swal.fire({title: "Zoznam materiálov", html: "Chyba:<br>" + error, icon: "warning"});
                    });
            })
        },
        ChangeArrow(id) {
            console.log($("#" + id).html())
            if ($("#" + id).html() == 'Vytvoriť objednávku <i class="fas fa-angle-down ms-2"></i>') {
                $("#" + id).html('Vytvoriť objednávku <i class="fas fa-angle-up ms-2"></i>');
            } else {
                $("#" + id).html('Vytvoriť objednávku <i class="fas fa-angle-down ms-2"></i>');
            }

        },

        createOrder(e) {
            e.preventDefault()

            if (this.fields.material_id === "" || this.fields.amount === "") {
                Swal.fire({
                    title: "Vytvorenie objednávky - Upozornenie",
                    html: "Musíte vyplniť všetky údaje.",
                    icon: 'warning',
                })
            } else {
                this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                    this.$axios.post(this.$BASE_PATH + 'api/createOrder', this.fields).then(response => {
                        if (response.data.success) {
                            Swal.fire({
                                title: "Vytvorenie objednávky",
                                text: "Objednávka bola úspešne vytvorená.",
                                icon: 'success',
                            }).then(function () {
                                window.location.reload()
                            })
                        } else {
                            this.error = response.data.message

                            Swal.fire({
                                title: "Vytvorenie objednávky - Neúspech",
                                html: "Objednávku sa nepodarilo vytvoriť:<br>" + this.error.toString(),
                                icon: 'warning',
                            })
                        }
                    })
                        .catch(function (error) {
                            console.error(error);
                            Swal.fire({
                                title: "Vytvorenie objednávky - Chyba",
                                html: "Chyba:<br>" + error.toString(),
                                icon: 'warning',
                            });
                        });
                })
            }
        }
    }
}
</script>

<style>

</style>
