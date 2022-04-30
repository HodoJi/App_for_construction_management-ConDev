<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Detail staveniska</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">{{ constructionName }} (stavenisko
                            #{{ constructionId }})</p>
                    </div>
                </div>

            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-info"><i
                    class="fas fa-list text-black fs-6"></i></button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <ul class="list-group">
                <router-link :to="{ name: 'zoznamMaterialov' }" style="text-decoration: none">
                    <li class="list-group-item align-middle">
                        <div class="row g-0 justify-content-center">
                            <div class="col">
                                <button type="button" class="btn btn-info">1.</button>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold text-center">Zoznam materiálov</div>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-info"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                    </li>
                </router-link>
                <router-link :to="{ name: 'zoznamPersonalu' }" style="text-decoration: none">
                    <li class="list-group-item align-middle">
                        <div class="row g-0 justify-content-center">
                            <div class="col">
                                <button type="button" class="btn btn-info">2.</button>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold text-center">Zoznam personálu</div>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-info"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                    </li>
                </router-link>
                <router-link :to="{ name: 'zoznamSoferov' }" style="text-decoration: none">
                    <li class="list-group-item align-middle">
                        <div class="row g-0 justify-content-center">
                            <div class="col">
                                <button type="button" class="btn btn-info">3.</button>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold text-center">Zoznam šoférov</div>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-info"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                    </li>
                </router-link>
                <router-link :to="{ name: 'zoznamObjednavok' }" style="text-decoration: none">
                    <li class="list-group-item align-middle">
                        <div class="row g-0 justify-content-center">
                            <div class="col">
                                <button type="button" class="btn btn-info">4.</button>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold text-center">Zoznam objednávok</div>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-info"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                    </li>
                </router-link>
            </ul>
        </div>
    </div>
    <div class="d-flex position-absolute bottom-0 start-50 translate-middle-x mb-5 mt-auto">
        <div class="btn-group d-flex" role="group">
            <button type="button" class="btn btn-warning me-1">Sklad</button>
            <button type="button" class="btn btn-primary w-100">Objednať</button>
        </div>
    </div>
    <Teleport to="body">
        <BurgerMenu :show="showModal" @close="showModal = false">
        </BurgerMenu>
    </Teleport>
</template>

<script>
import BurgerMenu from "./BurgerMenu";
import Swal from "sweetalert2";

export default {
    name: "detailStaveniska",
    components: {BurgerMenu},
    data() {
        return {
            constructionId: null,
            constructionName: "",
            showModal: false
        }
    },
    created() {
        this.$nextTick(function () {
            this.$axios.get(this.$BASE_PATH+'sanctum/csrf-cookie').then(() => {
                this.$axios.get(this.$BASE_PATH+`api/getConstructionDetail/${this.$route.params.id}`)
                    .then(response => {
                        console.log(response);
                        if (response.data[0]) {
                            this.constructionId = response.data[0].id;
                            this.constructionName = response.data[0].title;
                        } else {
                            Swal.fire({
                                title: "Detail staveniska",
                                text: "Chyba! " + response.data.message,
                                icon: "warning"
                            });
                        }

                    })
                    .catch(function (error) {
                        console.error(error);
                        Swal.fire({title: "Detail staveniska", html: "Chyba:<br>" + error, icon: "warning"});
                    });
            })


        })
    },
    methods: {
        //
    }
}
</script>

<style>

</style>
