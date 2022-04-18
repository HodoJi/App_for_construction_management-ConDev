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
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            name: "",
            isLoggedIn: true,
        }
    },
}
</script>

<style scoped>

</style>
