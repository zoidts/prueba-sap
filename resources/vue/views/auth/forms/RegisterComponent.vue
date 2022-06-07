<template>

              <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="assets/images/error/login-img.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
    <div class="card-body p-4 p-sm-5">
        <h5 class="card-title">Crear una cuenta</h5>
        <p class="card-text mb-5">
            Ingrese sus datos
        </p>
        <form class="form-body" @submit.prevent="onSubmit">

            <div class="row g-3">
                <div class="col-12">
                    <label for="inputName" class="form-label">Nombre</label>
                    <div class="ms-auto position-relative">
                        <div
                            class="position-absolute top-50 translate-middle-y search-icon px-3"
                        >
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <input
                            v-model="form.name"
                            type="text"
                            class="form-control radius-30 ps-5"
                            id="inputName"
                            placeholder="Ingrese su nombre completo"
                        />
                    </div>
                     <span v-if="errors.name" class="text-sm text-danger p-3">
                              {{errors.name[0]}}
                        </span>
                </div>
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
                         <span v-if="errors.email" class="text-sm text-danger p-3">
                                {{errors.email[0]}}
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
                      <span v-if="errors.password"  class="text-sm text-danger p-3">
                            {{errors.password[0]}}
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
                    <div class="form-check form-switch">
                        <input
                            v-model="terms"
                            class="form-check-input"
                            type="checkbox"
                            id="flexSwitchCheckChecked"
                        />
                        <label

                            class="form-check-label"
                            for="flexSwitchCheckChecked"
                            >Acepto los términos y condiciones</label
                        >
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-grid">
                        <button type="submit" :disabled="disabled" class="btn btn-primary radius-30">
                            Registrarse
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <p class="mb-0">
                        ¿Ya tienes una cuenta?
                        <router-link :to="{name: 'login'}">Inicia sesión aquí</router-link>
                    </p>
                </div>
            </div>
        </form>
    </div>

                </div>
              </div>

</template>

<script>

export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            terms: false,
            disabled: false,
            errors: {},
        };
    },

    computed: {
      disabled(){
          return this.disabled = !this.terms
      }
    },

    methods: {
        onSubmit() {

            this.disabled = true
                 axios
                     .post("/register", this.form)
                     .then((res) => {
                         console.log(res);
                         store.dispatch("setAuthUser");
                         this.$router.push({name:'dashboard'})
                     })
                     .catch((error) => {
                           this.disabled = false
                         this.errors = error.response.data.errors;
                     });

        },
    },
};
</script>
