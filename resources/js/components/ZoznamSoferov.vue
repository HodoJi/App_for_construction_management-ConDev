<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Zoznam šoférov</h4>
                    </div>

                </div>

            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-dark"><i class="fas fa-list fs-6"></i>
                </button>
                <button type="button" onclick="history.back()" class="btn btn-primary ms-2"><i
                    class="fas fa-arrow-left fs-6"></i>
                </button>
            </div>
        </div>
        <div class="align-items-center justify-content-center">
            <h4>Šoféri</h4>

            <ul class="list-group" v-if="drivers.length > 0" v-for="(driver, index) in drivers">
                <li class="list-group-item align-middle">
                    <div class="row g-0 justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-dark">{{index + 1}}.</button>
                        </div>
                        <div class="col-auto">
                            <div class="fw-bold text-center">{{ driver.name }}</div>
                        </div>

                        <div class="col text-end">
                            <a id="soferHardcodeLink" href="#soferHardcode" type="button" class="btn btn-dark"
                               data-bs-toggle="collapse"
                               role="button" aria-expanded="false" aria-controls="collapseExample"
                               @click="ChangeArrow('soferHardcodeLink')"><i class="fas fa-angle-down"></i></a>
                        </div>

                    </div>

                    <div class="collapse" id="soferHardcode">
                        <div class="align-items-center justify-content-center">
                            <ul class="list-group-flush p-3 mt-3 border border-info rounded-top border-bottom-0">
                                <li class="list-group-item align-middle">
                                    <!-- // Možno časom
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
                                       </div> // -->
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
                                            <p class="fw-lighter">Vykonáva XY</p>
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
                                            <p class="fw-lighter">Stavenisko XY</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </li>
            </ul>

        </div>

    </div>
    <Teleport to="body">
        <BurgerMenu :show="showModal" @close="showModal = false" :role_id="role_id">
        </BurgerMenu>
    </Teleport>
</template>

<script>

    import $ from "jquery";
    import Swal from "sweetalert2";
    import BurgerMenu from "./BurgerMenu";

    export default {
        name: "ZoznamSoferov",
        components: {
            BurgerMenu
        },
        data()
        {
            return {
                role_id: window.Laravel.user.role_id,
                showModal: false,
                drivers: [],
            }
        },

        mounted: function ()
        {
            this.$nextTick(function ()
            {

                this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() =>
                {
                    this.$axios.get(this.$BASE_PATH + `api/construction-drivers-show`)
                        .then(response =>
                        {

                            if (response.data)
                            {
                                this.drivers = response.data

                                if (this.drivers.length > 0)
                                    this.drivers.success = true

                                if (!this.drivers.success)
                                {
                                    Swal.fire({
                                        title: "Zoznam šoférov",
                                        html: "Chyba:<br>" + "Nepodarilo sa nájsť žiadny záznam.",
                                        icon: "warning"
                                    });
                                    this.$router.push({name: 'home'})
                                }
                            }
                            else
                            {
                                Swal.fire({title: "Zoznam šoférov", text: "Chyba!", icon: "warning"});
                            }

                        })
                        .catch(function (error)
                        {
                            console.error(error);
                            Swal.fire({title: "Zoznam šoférov", html: "Chyba:<br>" + error, icon: "warning"});
                        });
                })

            })
        },
        methods: {
            ChangeArrow(id)
            {
                console.log($("#" + id).html())
                if ($("#" + id).html() === '<i class="fas fa-angle-down"></i>')
                {
                    $("#" + id).html('<i class="fas fa-angle-up"></i>');
                }
                else
                {
                    $("#" + id).html('<i class="fas fa-angle-down"></i>');
                }

            }
        }
    }

</script>

<style>

</style>
