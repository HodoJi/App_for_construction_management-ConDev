<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam materiálov</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Tr. A. Hlinku 1 (stavenisko #3)</p>
                    </div>
                </div>


            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" class="btn btn-dark"><i class="fas fa-list fs-6"></i></button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <ul class="list-group">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">1.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Drevo</div>
                        </div>
                        <div class="col text-end">
                            <button type="button" class="btn btn-dark">60 ks</button>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">2.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Železo</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamPersonalu' }" class="btn btn-dark">1 t</router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">3.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Cement</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamSoferov' }" class="btn btn-dark">22 kg</router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">4.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Malta</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamObjednavok' }" class="btn btn-dark">12 kg</router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">4.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Tehla</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamObjednavok' }" class="btn btn-dark">120 ks</router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">4.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Ytong</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamObjednavok' }" class="btn btn-dark">44 ks</router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">4.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Sadrokartón</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'zoznamObjednavok' }" class="btn btn-dark">50 ks</router-link>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="d-flex position-absolute bottom-0 start-50 translate-middle-x mb-5 mt-auto">
        <div class="btn-group d-flex" role="group">
            <button type="button" class="btn btn-warning me-1">Sklad</button>
            <button type="button" class="btn btn-primary w-100">Objednať</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ZoznamMaterialov",
    data() {

    },
    methods: {
        //
    }
}
</script>

<style>

</style>
