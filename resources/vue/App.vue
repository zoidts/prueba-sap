<template>

   <authComponent v-if="!isAuth" :isAuth="isAuth"/>
   <MasterComponent v-else/>
</template>

<script>
import authComponent from './views/auth/authComponent';
import MasterComponent from './views/dashboard/layouts/MasterComponent.vue';

export default {
      components: {
      authComponent,
      MasterComponent
    },

     beforeCreate(){
        store.dispatch('setAuthUser');
    },
    computed:{
        isAuth(){
            return (state.authUser) ? true : false;
        }
    }


}
</script>

