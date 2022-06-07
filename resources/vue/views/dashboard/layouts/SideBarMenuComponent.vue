<template>
 <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div @click="$emit('toggled')">
              <img src="assets/images/logo-icon.png" class="logo-icon" style="cursor:pointer" alt="logo icon">
            </div>
            <div>
              <h4 class="logo-text">TO DO LIST</h4>
            </div>
            <div class="toggle-icon ms-auto" @click="$emit('toggled')"><i class="bi bi-chevron-double-left"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
            <li>
               <a href="javascript:void(0)">
                <div class="parent-icon"><i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a>
            </li>
            <li>
              <ul>
                <li><router-link :to="{name: 'dashboard'}"><i class="bi bi-arrow-right-short"></i>Todo List</router-link>
                </li>
                 <li><LogOutComponent icon="bi bi-arrow-right-short"></LogOutComponent>
                </li>

              </ul>
            </li>

          </ul>
          <!--end navigation-->
       </aside>

</template>
<script>
import LogOutComponent from '../user/LogOutComponent.vue';
export default {
    components: {
        LogOutComponent
    },
     data(){
         return {
             user: [],
         }
    },
    mounted() {
        this.user = store.state.authUser;
       },

}

</script>
