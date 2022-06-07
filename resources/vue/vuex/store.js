import axios from 'axios';
import {createStore} from 'vuex'

const store = createStore({
    state(){
        return {
            authUser: null,
        }
    },
    mutations:{
        auth(state, user){
            state.authUser = user;
        }
    },
    actions:{
        async setAuthUser(){
            try{
                let response = await axios.get('/sanctum/csrf-cookie');
                let authResponse = await axios.get('/api/get-auth-user');
                    if(authResponse.data.validation){
                        this.commit('auth', authResponse.data.user)
                    }else{
                        this.commit('auth', null)
                    }
             return authResponse.data.user
            } catch(error) {
                console.log(error)
                this.commit('auth', null)
            }
        }
    }
});

export default store;
