<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="text-center text-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>
                            Neautorizovaný prístup</h4>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-primary"><i
                    class="fas fa-list text-black fs-6"></i></button>
                <button type="button" onclick="history.back()" class="btn btn-primary ms-2"><i
                    class="fas fa-arrow-left fs-6"></i>
                </button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <router-link :to="{ name: 'home' }" class="list-group-item list-group-item-action"><i
                class="fas fa-arrow-right"></i> Späť na zoznam stavenísk
            </router-link>
        </div>
    </div>
    <Teleport to="body">
        <BurgerMenu :show="showModal" @close="showModal = false">
        </BurgerMenu>
    </Teleport>

</template>

<script>

    import BurgerMenu from "./BurgerMenu";

    export default {
        name: "e401",
        components: {
            BurgerMenu
        },
        data()
        {
            return {
                showModal: false,
            }
        },
        methods: {
            //
        }
    }

</script>

<style>

</style>
