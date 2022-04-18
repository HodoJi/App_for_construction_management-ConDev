<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam personálu</h4>
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
            <h4>Robotníci</h4>
            <ul class="list-group">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-primary">1.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">John Doe</div>
                        </div>
                        <div class="col text-end">
                            <router-link :to="{ name: 'detailstaveniska' }" class="btn btn-primary"><i class="fas fa-angle-right"></i></router-link>
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
                            <button type="button" class="btn btn-primary"><i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <h4 class="mt-3">Šoféri</h4>
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
                            <router-link :to="{ name: 'detailstaveniska' }" class="btn btn-primary"><i class="fas fa-angle-right"></i></router-link>
                        </div>
                    </div>
                </li>
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-primary">2.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">Jane Doe</div>
                        </div>
                        <div class="col text-end">
                            <button type="button" class="btn btn-primary"><i class="fas fa-angle-right"></i></button>
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
</template>

<script>
export default {
    name: "ZoznamPersonalu",
    data() {

    },
    methods: {
        //
    }
}
</script>

<style>

</style>
