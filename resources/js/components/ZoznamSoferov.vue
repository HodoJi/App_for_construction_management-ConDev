<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam šoférov</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Tr. A. Hlinku 1 (stavenisko #3)</p>
                    </div>
                </div>

            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" class="btn btn-primary"><i class="fas fa-list text-black fs-6"></i></button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <ul class="list-group">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-primary">1.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Kevin Doe</div>
                        </div>
                        <div class="col text-end">
                            <a id="kevinDoeLink" href="#kevinDoe" type="button" class="btn btn-primary" data-bs-toggle="collapse"
                               role="button" aria-expanded="false" aria-controls="collapseExample"
                               @click="ChangeArrow('kevinDoeLink')"><i class="fas fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="kevinDoe">
                        <div class="align-items-center justify-content-center">
                            <ul class="list-group-flush p-3 mt-3 border border-info rounded-top border-bottom-0">
                                <li class="list-group-item align-middle">
                                    <div class="row g-0 justify-content-center">
                                        <div class="col">
                                            <p class="fw-bold">Vozidlo:</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-bold text-center"></div>
                                        </div>
                                        <div class="col text-end">
                                            <p class="fw-lighter">Vozidlo #4</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item align-middle">
                                    <div class="row g-0 justify-content-center">
                                        <div class="col">
                                            <p class="fw-bold">Status:</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-bold text-center"></div>
                                        </div>
                                        <div class="col text-end">
                                            <p class="fw-lighter">Nakladá tovar</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item align-middle">
                                    <div class="row g-0 justify-content-center">
                                        <div class="col">
                                            <p class="fw-bold">Destinácia:</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-bold text-center"></div>
                                        </div>
                                        <div class="col text-end">
                                            <p class="fw-lighter">Stavenisko #3</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary w-100 rounded-0 rounded-bottom">Informácie o preprave</button>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-primary">2.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Frank Doe</div>
                        </div>
                        <div class="col text-end">
                            <button type="button" class="btn btn-primary"><i class="fas fa-angle-down"></i></button>
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

import $ from "jquery";
export default {
    name: "ZoznamSoferov",
    data() {

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
