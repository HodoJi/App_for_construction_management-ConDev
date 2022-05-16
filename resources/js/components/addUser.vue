<template>
    <div class="container-sm">
        <div class="row pt-3 m-3">
            <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="row">
                    <div class="col-12 mb-0 pb-0">
                        <h4 class="fw-bold">Pridať nového zamestnanca</h4>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <p class="small text-muted fw-light">Počet zamestnancov: {{ employees.length }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-start justify-content-end">
                <button type="button" @click="showModal = true" class="btn btn-primary"><i
                    class="fas fa-list text-black fs-6"></i></button>
                <button type="button" onclick="history.back()" class="btn btn-primary ms-2"><i class="fas fa-arrow-left fs-6"></i>
                </button>
            </div>
        </div>
        <!-- ↓ VYTVORENIE POUŽÍVATEĽA ↓ -->
        <form class="border border-dark rounded opacity-75 p-3 mb-5">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="mb-3">
                        <label for="userArray.name" class="form-label"><span style="color: #ff0000">*</span> Meno a priezvisko</label><!-- FULLNAME -->
                        <input v-model="userArray.name" type="text" class="form-control" id="userArray.name" placeholder="Meno" required>
                        <div id="nameHelp" class="form-text">Zadajte celé meno zamestnanca</div>
                    </div>
                    <div class="mb-3">
                        <label for="userArray.email" class="form-label"><span style="color: #ff0000">*</span> E-mailová adresa</label><!-- E-MAIL -->
                        <input v-model="userArray.email" type="email" class="form-control" id="userArray.email" placeholder="E-mail" required>
                        <div id="emailHelp" class="form-text">Zadajte email zamestnanca</div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="mb-3"><!-- ROLE -->
                        <label class="form-label" for="userArray.role"><span style="color: #ff0000">*</span> Pozícia</label>
                        <select v-model="userArray.role" class="form-select" id="userArray.role" required>
                            <option value="robotnik">Robotník</option>
                            <option value="sofer">Šofér</option>
                            <option value="stavbyveduci">Stavbyvedúci</option>
                        </select>
                        <div id="roleHelp" class="form-text">Vyberte pozíciu zamestnanca</div>
                    </div>
                    <input id="create_user" type="submit" class="btn btn-primary float-end" @click="createUser" value="Vytvoriť zamestnanca">
                </div>
            </div>
        </form>

        <!-- ↓ ZOZNAM EXISTUJÚCICH POUŽÍVATEĽOV ↓ -->
        <div class="align-items-center justify-content-center">
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Meno</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Osobný kľúč</th>
                    <th scope="col">Pozícia</th>
                    <th scope="col">Akcia</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(employee, index) in employees">
                    <th scope="row">{{ index + 1 }}.</th>
                    <td class="fw-bold">{{ employee.name }}</td>
                    <td>{{ employee.email }}</td>
                    <td>{{ employee.personalId }}</td>
                    <td>
                        <span class="btn btn-danger float-end w-100" v-if="employee.role_id === 1">Správca <i class="fas fa-crown"></i></span>
                        <span class="btn btn-primary float-end w-100" v-if="employee.role_id === 2">Stavbyvedúci <i class="fas fa-user-tie"></i></span>
                        <span class="btn btn-info float-end w-100" v-if="employee.role_id === 3">Robotník <i class="fas fa-hard-hat"></i></span>
                        <span class="btn btn-info float-end w-100" v-if="employee.role_id === 4">Šofér <i class="fas fa-truck-pickup"></i></span>
                    </td>
                    <td class="text-center"><router-link :to="{ name: `editUser`, params: {id: employee.id} }" class="btn btn-primary" style="text-decoration: none"><i class="fas fa-edit"></i> Upraviť</router-link></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <Teleport to="body">
        <BurgerMenu :show="showModal" @close="showModal = false" :role_id="role_id">
        </BurgerMenu>
    </Teleport>

</template>

<script>
import BurgerMenu from "./BurgerMenu";
import Swal from "sweetalert2";

export default {
    name: "addUser",
    components: {
        BurgerMenu
    },
    data() {
        return {

            role_id: window.Laravel.user.role_id,
            showModal: false,

            error: null,

            userArray: {
                name: '',
                email: '',
                role: 'robotnik',
            },

            employees: [],
        }
    },
    mounted: function () {
        this.$nextTick(() => {

            this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() =>
            {
                this.$axios.post(this.$BASE_PATH + 'api/showExistingUsers')
                    .then(response =>
                    {
                        if (response.data)
                        {
                            this.employees = response.data
                        }
                    })
                    .catch((error) =>
                    {
                        Swal.fire({
                            title: "Chyba",
                            html: "Chyba pridania existujúcich používateľov do zoznamu `employees`:<br>" + error.toString()
                        })
                    })
            })
        })
    },
    methods: {

        createUser(e)
        {
            e.preventDefault()

            if (this.userArray.email === "" || this.userArray.name === "")
            {
                Swal.fire({
                    title: "Vytvorenie používateľa - Upozornenie",
                    html: "Musíte vyplniť všetky údaje.",
                    icon: 'warning',
                })
            }
            else
            {

                let user_role_id = 3
                switch (this.userArray.role)
                {
                    case 'admin':
                        user_role_id = 1
                        break
                    case 'stavbyveduci':
                        user_role_id = 2
                        break
                    case 'robotnik':
                        user_role_id = 3
                        break
                    case 'sofer':
                        user_role_id = 4
                        break
                }

                this.$axios.get(this.$BASE_PATH + 'sanctum/csrf-cookie').then(() =>
                {
                    this.$axios.post(this.$BASE_PATH + 'api/createUser', {
                        rq_user_name: this.userArray.name,
                        rq_user_email: this.userArray.email,
                        rq_user_role_id: user_role_id,
                    }) //: ↓
                        .then(response =>
                        {
                            if (response.data.success)
                            {
                                Swal.fire({
                                    title: "Vytvorenie používateľa",
                                    text: "Používateľ bol úspešne vytvorený.",
                                    icon: 'success',
                                }).then(function ()
                                {
                                    window.location.reload()
                                })
                            }
                            else
                            {
                                this.error = response.data.message

                                Swal.fire({
                                    title: "Vytvorenie používateľa - Neúspech",
                                    html: "Používateľa sa nepodarilo vytroviť:<br>" + this.error.toString(),
                                    icon: 'warning',
                                })
                            }
                        })
                        .catch(function (error)
                        {
                            console.error(error);
                            Swal.fire({
                                title: "Vytvorenie používateľa - Chyba",
                                html: "Chyba:<br>" + error.toString(),
                                icon: 'warning',
                            });
                        });
                })
            }
        }

    }
}
</script>

<style>
</style>
