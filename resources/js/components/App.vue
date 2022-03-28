<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <router-link :to="{ name: 'home' }" class="navbar-brand">App for construction management</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item" v-if="isLoggedIn">
                            <router-link :to="{ name: 'home' }" class="nav-link">Domov</router-link>
                        </li>
                        <li class="nav-item" v-if="isLoggedIn">
                            <a class="nav-link text-danger" style="cursor: pointer" @click="logout">Odhlásiť sa</a>
                        </li>
                        <li class="nav-item" v-else>
                            <router-link :to="{ name: 'login' }" class="nav-link">Prihlásiť sa</router-link>
                        </li>
                    </ul>
                </div>
                <a v-if="isLoggedIn">Vitaj {{ name }}</a>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </main>
    <footer class="footer mt-auto text-center text-lg-start border-top border-primary">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Jako?</h5>
                    <p>
                        <!-- opis stránky -->
                    </p>
                </div>
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0 float-end">
                    <h5 class="text-uppercase">Autori</h5>
                    <p>
                        Systém vytvorili
                    </p>
                    <ul>
                        <li>peepo 1...</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-2">
            <button id="themeSwitch" class="btn btn-primary">🌙</button>
        </div>
        <div class="text-center p-3 bg-primary text-white">
            2022 &lt;footer&gt;
        </div>
    </footer>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            name: "",
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedIn) {
            window.location.href = "./";
        }
        next();
    },
    methods: {
        logout(e) {
            e.preventDefault()
            this.$axios.get('./sanctum/csrf-cookie').then(response => {
                this.$axios.post('./api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "./login"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>
<style>

</style>
