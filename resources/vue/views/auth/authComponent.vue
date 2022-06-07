<template>

       <main class="authentication-content">
        <div class="container-fluid">
            <div class="authentication-card">
                <div class="card shadow rounded-0 overflow-hidden">
                    <div class="row g-0">
                        <router-view v-if="!isAuth"></router-view>

                    </div>
                </div>
            </div>
        </div>
    </main>

</template>
<script>

import LoginComponent from './forms/LoginComponent.vue'
import RegisterComponent from './forms/RegisterComponent.vue'
import ForgotPasswordComponent from './forms/ForgotPasswordComponent.vue'
import ResetPasswordComponent from './forms/ResetPasswordComponent.vue'

export default {
     props: {
         isAuth: {
              type: Boolean,
              required: true

         }
     },
    components: {
        LoginComponent,
        RegisterComponent,
        ForgotPasswordComponent,
        ResetPasswordComponent
    },

}

</script>
