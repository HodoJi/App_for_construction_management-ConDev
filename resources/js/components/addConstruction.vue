<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Vytvoriť nové stavenisko</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Počet stavenísk: {{ constructionCounter }}</p>
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
                <div class="col-lg-12 col-sm-12">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Celá adresa staveniska</label>
                        <input type="text" class="form-control" id="inputName" v-model="constructionName">
                        <div id="nameHelp" class="form-text">Zadaj celé adresu nového staveniska</div>
                    </div>
                    <button type="button" class="btn btn-primary float-end" @click="addConstr()"><i class="fas fa-edit"></i> Vytvoriť stavenisko</button>
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
    name: "addConstruction",
    components: {
        BurgerMenu
    },
    data() {
        return {
            role_id: window.Laravel.user.role_id,
            showModal: false,
            constructionCounter: 0,
            constructionName: ""
        }
    },
    mounted(){
        this.getNumberOfConstr();
    },
    methods: {
        addConstr(){
            this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                this.$axios.put(this.$BASE_PATH + `api/addConstruction`, {constructionName:this.constructionName})
                    .then(response => {
                        if (response.data)
                        {
                            if (!response.data.success)
                            {
                                Swal.fire({title: "Staveniská", html: "Chyba:<br>" + response.data.message, icon: "warning"});
                            } else {
                                Swal.fire({title: "Staveniská", html: response.data.message, icon: "success"}).then((result) =>
                                {
                                    if (result.isConfirmed)
                                    {
                                        window.location.href = this.$BASE_PATH
                                    }
                                });
                            }
                            this.getNumberOfConstr();
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                        Swal.fire({title: "Staveniská", html: "Chyba:<br>" + error, icon: "warning"});
                    });
            })
        },
        getNumberOfConstr(){
            this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() => {
                this.$axios.get(this.$BASE_PATH + `api/getConstructionCount`)
                    .then(response => {
                        this.constructionCounter = response.data[0].count_of_constructions;
                    })
                    .catch(function (error) {
                        console.error(error);
                        Swal.fire({title: "Staveniská", html: "Chyba:<br>" + error, icon: "warning"});
                    });
            })
        }
        //
    }
}
</script>

<style>

</style>
