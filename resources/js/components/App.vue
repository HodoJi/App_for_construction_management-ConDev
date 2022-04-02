<template>
    <main class="h-100">
        <router-view></router-view>
    </main>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            name: "",
            isLoggedIn: true,
        }
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
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";SameSite=Strict; Secure;" + "path=/";
}

import $ from 'jquery';

$(document).ready(function () {
    $('#themeSwitch').click(function () {
        let themeSelected = $('#themeLink').attr('class');
        if (themeSelected === 'light') {
            setCookie("UserThemeTP2Management", "themeIsDark", 90);
            $('link[id="themeLink"]').attr('href', './css/dark_mode.css').attr('class', 'dark');
            $('#themeSwitch').html('&#x1F31E;');
        }
        if (themeSelected === 'dark') {
            setCookie("UserThemeTP2Management", "", -1);
            $('link[id="themeLink"]').attr('href', './css/light_mode.css').attr('class', 'light');
            $('#themeSwitch').html('🌙');
        }
    });
});
$(document).ready(function () {
    if (document.cookie.indexOf('UserThemeTP2Management') > -1) {
        $('#themeSwitch').html('&#x1F31E;');
    }
});
</script>
<style>

</style>
