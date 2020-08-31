import Vue from "vue";
import Router from "vue-router";
// import AppHeader from "./layout/AppHeader";
// import AppFooter from "./layout/AppFooter";
// import Components from "./views/Components.vue";
import Index from "./views/index.vue";
// import Login from "./views/Login.vue";
// import Register from "./views/Register.vue";
// import Profile from "./views/Profile.vue";

Vue.use(Router);

export default new Router({
  linkExactActiveClass: "active",
  routes: [
    {
      path: "/",
      name: "home",
      components: {
        default: Index,
      }
    },
    // {
    //   path: "/components",
    //   name: "Components",
    //   components: {      
    //     default: Components,      
    //   }
    // },
    
  ],
  scrollBehavior: to => {
    if (to.hash) {
      return { selector: to.hash };
    } else {
      return { x: 0, y: 0 };
    }
  }
});
