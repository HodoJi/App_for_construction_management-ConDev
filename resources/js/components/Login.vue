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
                <p class="small text-muted fw-light">Prihláste sa so svojim osobným kľúčom</p>
                <div class="form-group">
                    <label for="personalId" class="form-label mt-4 text-danger fw-bold">Osobný kľúč</label>
                    <input type="text" v-model="personalId" class="form-control border-0 border-bottom shadow-none" id="personalId" name="personalId" aria-describedby="personalCode" maxlength="9" minlength="9" autofocus required>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button id="loginBtn" class="btn btn-primary" type="submit" @click="handleLogin">Prihlásiť sa</button>
                </div>
            </fieldset>
        </form>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import jQuery from "jquery";

jQuery(document).ready(function() {
    jQuery("#loginBtn").prop("disabled", true);

    jQuery("#personalId").on('input', function() {

        if (jQuery("#personalId").val().length < 1)
        {
            jQuery("#loginBtn").prop("disabled", true);
        }
        else
        {
            jQuery("#loginBtn").prop("disabled", false);
        }

    })
});

export default {
    data() {
        return {
            personalId: "",
            error: null
        }
    },
    methods: {
        handleLogin(e) {
            e.preventDefault()
            if (this.personalId.length > 8 && this.personalId.length < 10) {
                this.$axios.get('./sanctum/csrf-cookie').then(response => {
                    this.$axios.post('./api/login', {
                        personalId: this.personalId,
                    })
                        .then(response => {
                            console.log(response.data)
                            if (response.data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Úspech!',
                                    text: 'Ste prihlásený. Kliknite na OK pre pokračovanie.',
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "./"
                                    } else {
                                        window.location.href = "./"
                                    }
                                });
                            } else {
                                this.error = response.data.message
                                Swal.fire({
                                    title: "Prihlásenie",
                                    text: "Zadali ste neplatný osobný kľúč.",
                                    icon: 'warning'
                                });
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                            Swal.fire({
                                title: "Prihlásenie - Chyba",
                                html: 'Z nejakého dôvodu sa prihlásenie nepodarilo!<br>Chyba: ' + error,
                                icon: 'warning'
                            });
                        });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next({ name: 'home' });
        }
        next();
    }
}
</script>
