<template>
    <div class="row g-0">
        <div
            class="col-lg-6 d-flex align-items-center justify-content-center border-end"
        >
            <img
                src="/assets/images/error/forgot-password-frent-img.jpg"
                class="img-fluid"
                alt=""
            />
        </div>
        <div class="col-lg-6">
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title">Generar nueva contraseña</h5>
                <p class="card-text mb-5">
                    Recibimos su solicitud de restablecimiento de contraseña.
                    ¡Por favor ingrese su nueva contraseña!
                </p>
                <form class="form-body" @submit.prevent="onSubmit">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label"
                                >Correo electrónico</label
                            >
                            <div class="ms-auto position-relative">
                                <div
                                    class="position-absolute top-50 translate-middle-y search-icon px-3"
                                >
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    class="form-control radius-30 ps-5"
                                    id="inputEmailAddress"
                                    placeholder="Ingrese su correo electrónico"
                                />
                            </div>
                            <span
                                v-if="errors.email"
                                class="text-sm text-danger p-3"
                            >
                                {{ errors.email[0] }}
                            </span>
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label"
                                >Contraseña</label
                            >
                            <div class="ms-auto position-relative">
                                <div
                                    class="position-absolute top-50 translate-middle-y search-icon px-3"
                                >
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    class="form-control radius-30 ps-5"
                                    id="inputChoosePassword"
                                    placeholder="Ingrese su contraseña"
                                />
                            </div>
                            <span
                                v-if="errors.password"
                                class="text-sm text-danger p-3"
                            >
                                {{ errors.password[0] }}
                            </span>
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label"
                                >Confirmación de contraseña</label
                            >
                            <div class="ms-auto position-relative">
                                <div
                                    class="position-absolute top-50 translate-middle-y search-icon px-3"
                                >
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                                <input
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="form-control radius-30 ps-5"
                                    id="inputChoosePassword"
                                    placeholder="Ingrese la confirmación de su contraseña"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-3">
                                <button
                                    type="submit"
                                    class="btn btn-primary radius-30"
                                >
                                    Cambia la contraseña
                                </button>
                                <router-link
                                    :to="{ name: 'login' }"
                                    class="btn btn-lg btn-light radius-30"
                                    >Atrás para iniciar sesión</router-link
                                >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { ElNotification } from "element-plus";

export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
                password_confirmation: "",
                token: "",
            },
            disabled: false,
            errors: {},
        };
    },
    mounted() {
        this.form.email = this.$route.query.email;
        this.form.token = this.$route.params.token;
    },

    methods: {
        onSubmit() {
            this.disabled = true;
            axios
                .post("/reset-password", this.form)
                .then((res) => {
                    store.dispatch('setAuthUser');
                    ElNotification({
                        title: "Constraseña restablecida",
                        message:
                            "Se ha restablecido la contraseña con éxito",
                        type: "success",
                    });
                    this.$router.push({name: 'login'})
                })
                .catch((error) => {
                    this.disabled = false;
                    this.errors = error.response.data.errors;
                    console.log(error);
                });
        },
    },
};
</script>
