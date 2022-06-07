<template>
    <!--start top header-->
    <header class="top-header">
      <nav class="navbar navbar-expand">
        <div class="mobile-toggle-icon d-xl-none" @click="$emit('toggled')">
            <i class="bi bi-list"></i>
          </div>
          <div class="top-navbar d-none d-xl-block">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item">
            <a class="nav-link" href="index.html">Dashboard</a>
            </li>
              <li class="nav-item d-none d-xxl-block">
              <a class="nav-link" href="app-to-do.html">Lista de tareas</a>
              </li>
          </ul>
          </div>
          <div class="top-navbar-right ms-3 ">
            <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-1">
                  <img src="assets/images/avatars/avatar-1.png" class="user-img" alt="">
                  <div class="user-name d-none d-sm-block">{{user.name}}</div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                        <img src="assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="60" height="60">
                        <div class="ms-3">
                          <h6 class="mb-0 dropdown-user-name">{{user.name}}</h6>
                          <small class="mb-0 dropdown-user-designation text-secondary">Usuario</small>
                        </div>
                     </div>
                   </a>
                 </li>
                 <li><hr class="dropdown-divider"></li>
                  <li>
                      <div class="d-flex align-items-center">
                         <div class="setting-text ms-3">
                             <span> <log-out-component class="dropdown-item" icon="fadeIn animated bx bx-exit" text="Cerra Sesión"></log-out-component>
                             </span>
                             </div>
                       </div>


                  </li>
              </ul>
            </li>
            </ul>
            </div>
      </nav>
    </header>
       <!--end top header-->
</template>
<script>
import LogOutComponent from '../user/LogOutComponent.vue';
export default {
    components: {
        LogOutComponent
    },
     data(){
         return {
             user: []
         }
    },
    mounted() {
        this.user = store.state.authUser;
       }



};
</script>
