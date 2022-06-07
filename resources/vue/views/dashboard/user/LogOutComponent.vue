<template>
    <a
    href="#"
    @click="logout"
    ><i :class="icon"></i> {{text}}</a>
</template>

<script>
export default{
    props: {
        text: {
            type: String,
            default: "Cerrar sesión"
         },
         icon:{
            type: String,
            default: ""
         },
    },
    methods: {
        logout(){
            axios.post('/logout').then( res => {
                store.commit('auth', null);
                window.location.href = '//' + location.host;
            }).catch( error => {
                console.log(error);
            })
        }
    }
}
</script>
