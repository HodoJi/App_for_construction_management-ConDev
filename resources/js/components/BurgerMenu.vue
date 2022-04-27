<script>
export default {
    name: "BurgerMenu",
    props: {
        show: Boolean
    },
    data(){
        return{
            name: ""
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            this.$axios.get('./sanctum/csrf-cookie').then(response => {
                this.$axios.post('./api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = this.$BASE_PATH + "login"
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
<template>
    <Transition name="modal">
        <div v-if="show" class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Navigácia</h5>
                            <button type="button" class="btn-close" @click="$emit('close')"></button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group">
                                <router-link :to="{ name: 'home' }" @click="$emit('close')" class="list-group-item list-group-item-action"><i class="fas fa-arrow-right"></i> Zoznam stavenísk</router-link>
                                <a href="#" class="list-group-item list-group-item-danger bg-danger text-black mt-0" @click="logout"><i class="fas fa-sign-out-alt"></i> Odhlásiť sa</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="$emit('close')" class="btn btn-primary">Zatvoriť</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
<style>
.modal-container {
    width: 300px;
    margin: 0px auto;
    padding: 10px 15px;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
}
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}
.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-enter-from {
    opacity: 0;
}

.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>
