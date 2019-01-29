import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home";
import Users from "./views/users/Index";
import UserShow from "./views/users/Show";
import UserEdit from "./views/users/Edit";
import UserCreate from "./views/users/Create";
import UserImport from "./views/users/Import";


Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/", name: "home", component: Home
    },
    {
      path: "/users", name: "users", component: Users
    },
    {
      path: "/users/create", name: "userCreate", component: UserCreate
    },
    {
      path: "/users/import", name: "userImport", component: UserImport
    },
    {
      path: "/users/:id", name: "userShow", component: UserShow
    },
    {
      path: "/users/edit/:id", name: "userEdit", component: UserEdit
    },

  ],
  mode: 'history'
});
