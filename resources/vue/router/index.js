import { createWebHistory, createRouter } from "vue-router";
import store from "../vuex/store";
import routes from './routes'
const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach(async (to, from, next) => {
    const loggedIn = await store.dispatch('setAuthUser');
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
      next({name: 'login'})
      return
    }
    next()
  })


export default router;
