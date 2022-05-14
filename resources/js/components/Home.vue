<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam stavenísk</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Počet stavenísk: {{ constructions.length }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-primary"><i class="fas fa-list text-black fs-6"></i></button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <ul class="list-group" v-for="(construction, index) in constructions">
                <router-link :to="{ name: `detailStaveniska`, params: {id: construction.id} }" style="text-decoration: none"><!-- TODO: { Aké stavenisko vyberiem, call na => construction.id } -->
                    <li class="list-group-item align-middle">
                        <div class="row g-0 justify-content-center">
                            <div class="col">
                                <button type="button" class="btn btn-primary">{{ index + 1 }}.</button>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold text-center">{{ construction.title }}</div>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-primary">{{ construction.users_count }} <i class="fas fa-users"></i></button>
                            </div>
                        </div>
                    </li>
                </router-link>
            </ul>
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
    name: "Home",
    components:{
        BurgerMenu
    },
    data() {
        return{
            role_id: window.Laravel.user.role_id,
            showModal: false,
            constructions: [],
        }
    },
    mounted: function () {
        this.$nextTick(function () {
            this.$axios.get('./sanctum/csrf-cookie').then(() => {
                this.$axios.post('./api/constructions-list')
                    .then(response => {

                        if (response.data)
                        {
                            this.constructions = response.data;
                        }
                        else
                        {
                            Swal.fire({title: "Zoznam Stavenísk", text: "Chyba!", icon: "warning"});
                        }

                    })
                    .catch(function (error){
                        console.error(error);
                        Swal.fire({title: "Zoznam Stavenísk", html: "Chyba:<br>" + error, icon: "warning"});
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
