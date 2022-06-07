<template>
<div
                            class="col-lg-6 bg-login d-flex align-items-center justify-content-center"
                        >
                            <img
                                src="assets/images/error/login-img.jpg"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Iniciar Sesión</h5>
                                <p class="card-text mb-5">
                                    Ingrese sus datos de acceso
                                </p>
                                <form class="form-body" @submit.prevent="onSubmit">

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Correo electrónico</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i  class="bi bi-envelope-fill"></i>
                                                </div>
                                                <input
                                                    v-model="form.email"
                                                    type="email"
                                                    class="form-control radius-30 ps-5"
                                                    id="inputEmailAddress"
                                                    placeholder="Ingrese su correo electrónico"
                                                />
                                            </div>
                                            <span v-if="errors.email" class="text-sm text-danger p-3">
                                               {{errors.email[0]}}
                                            </span>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Contraseña</label>
                                             <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
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
                                             <span v-if="errors.password" class="text-sm text-danger p-3">
                                               {{errors.password[0]}}
                                            </span>
                                        </div>

                                        </div>
                                        <div class="col-12 text-end mt-4 mb-3">
                                            <router-link :to="{name:'recuperarpassword'}">¿Has olvidado tu contraseña ?</router-link>
                                            </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary radius-30"
                                                >
                                                    Iniciar sesión
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3">
                                                ¿Aún no tienes una cuenta?
                                                <router-link
                                                    :to="{ name: 'registro' }"
                                                    >Registrate aquí</router-link
                                                >
                                            </p>
                                        </div>
                                </form>
                                    </div>
                            </div>


</template>
<script>
export default {
    data(){
        return{
            form:{
                email: '',
                password: '',
            },
              disabled: false,
              errors: {},
        }
    },
       methods: {
        onSubmit(){

                this.disabled = true;
                axios.post('/login', this.form).then( res => {
                     store.dispatch("setAuthUser");
                         this.$router.push({name:'dashboard'})
                }).catch( error =>{
                    this.disabled = false;
                      this.errors = error.response.data.errors;

                })



        }
    }
};
</script>
