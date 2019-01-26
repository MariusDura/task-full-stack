import Vue from 'vue'
import App from './App.vue'
import router from "./router";
import store from "./store/index";

import './assets/scss/app.scss'

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})
