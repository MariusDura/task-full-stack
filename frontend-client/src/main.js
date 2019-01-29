import Vue from 'vue'
import App from './App.vue'
import router from "./router";
import store from "./store/index";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import './assets/scss/app.scss';

import 'sweetalert2/src/sweetalert2.scss'

Vue.component('font-awesome-icon', FontAwesomeIcon);

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
});
