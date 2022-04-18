<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Detail staveniska</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Tr. A. Hlinku 1 (stavenisko #3)</p>
                    </div>
                </div>


            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-info"><i class="fas fa-list text-black fs-6"></i></button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <ul class="list-group">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-info">1.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Zoznam materiálov</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznammaterialov' }" class="btn btn-info"><i class="fas fa-angle-right"></i></router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-info">2.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Zoznam personálu</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznampersonalu' }" class="btn btn-info"><i class="fas fa-angle-right"></i></router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-info">3.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Zoznam šoférov</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamsoferov' }" class="btn btn-info"><i class="fas fa-angle-right"></i></router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-info">4.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Zoznam objednávok</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamobjednavok' }" class="btn btn-info"><i class="fas fa-angle-right"></i></router-link>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="d-flex position-absolute bottom-0 start-50 translate-middle-x mb-5 mt-auto">
        <div class="btn-group d-flex" role="group">
            <button type="button" class="btn btn-warning">Sklad</button>
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
export default {
    components:{BurgerMenu},
    name: "DetailStaveniska",
    data() {
        return{
            showModal: false
        }
    },
    methods: {
        //
    }
}
</script>

<style>

</style>
