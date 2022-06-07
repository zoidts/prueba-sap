<template>

              <div class="row g-0">
                <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                  <img src="assets/images/error/forgot-password-frent-img.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">¿Has olvidado tu contraseña?</h5>
                    <p class="card-text mb-5">Ingrese su correo electrónico registrado para restablecer la contraseña</p>
                    <form class="form-body" @submit.prevent="onSubmit">
                        <div class="row g-3">
                          <div class="col-12">
                          <label
                                                for="inputEmailAddress"
                                                class="form-label"
                                                >Correo electrónico</label
                                            >
                                            <div
                                                class="ms-auto position-relative"
                                            >
                                                <div
                                                    class="position-absolute top-50 translate-middle-y search-icon px-3"
                                                >
                                                    <i
                                                        class="bi bi-envelope-fill"
                                                    ></i>
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
                            <div class="d-grid gap-3">
                              <button type="submit" class="btn btn-lg btn-primary radius-30">Enviar</button>
                                   <router-link :to="{name: 'login'}" class="btn btn-lg btn-light radius-30">Atrás para iniciar sesión</router-link>
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
    data(){
        return{
            form:{
                email: '',
            },
             disabled: false,
             errors: {},
        }
    },
    emits: {
        submit: (payload) => {
            return payload
        }
    },
       methods: {
        onSubmit(){

                this.disabled = true;
                axios.post('/forgot-password', this.form).then( res => {
                     this.$emit('submit', {res: res})
                      ElNotification({
                        title: "Recupera contraseña",
                        message: "Se ha enviado un correo para recuperar tu cuenta",
                        type: "success",
                    });
                }).catch( error =>{
                    this.disabled = false;
                    this.errors = error.response.data.errors;
                    console.log(error)
                })



        }
    }
}
</script>
