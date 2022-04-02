<template>
    <div class="d-flex align-items-center justify-content-center">
        <i class="fas fa-wrench fa-flip-horizontal text-primary fa-3x pt-5 pe-5 ps-5 pb-2"></i>
    </div>
    <div class="d-flex align-items-center justify-content-center mb-3">
        <p class="small text-muted fw-light">TP2 Management</p>
    </div>
    <div class="d-flex align-items-center justify-content-center">
        <form>
            <fieldset>
                <legend class="fw-bold">Prihlásenie</legend>
                <p class="small text-muted fw-light">Prihlás sa so svojim osobným kódom</p>
                <div class="form-group">
                    <label for="personalCode" class="form-label mt-4 text-danger fw-bold">Osobný kód</label>
                    <input type="text" class="form-control border-0 border-bottom shadow-none" id="personalCode" aria-describedby="personalCode">
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" type="button">Prihlásiť sa</button>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="d-flex align-items-center justify-content-center fixed-bottom small mb-5">
        Zabudol si kód?
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {

    },
    methods: {
        //
    }
}
</script>

<style scoped>

</style>
