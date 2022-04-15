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
                    <label for="personalId" class="form-label mt-4 text-danger fw-bold">Osobný kód</label>
                    <input type="text" v-model="personalId" class="form-control border-0 border-bottom shadow-none" id="personalId" name="personalId" aria-describedby="personalCode" maxlength="9" minlength="9" required>
                    <input type="hidden" name="password" value="0">
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" type="submit" @click="handleLogin">Prihlásiť sa</button>
                </div>
            </fieldset>
        </form>
    </div>
</template>

<script>
import Swal from "sweetalert2";
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
                        password: 0
                    })
                        .then(response => {
                            console.log(response.data)
                            if (response.data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Úspech!',
                                    text: 'Si prihlásený. Klikni na OK pre pokračovanie',
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
                                title: "Prihlásenie",
                                text: 'Účet bol zablokovaný na 1 hodinu. Príliš veľa pokusov o prihlásenie !',
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
