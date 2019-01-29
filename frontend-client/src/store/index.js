import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import {BASE_API_URL} from "../constants";

const api = axios.create({
  baseURL: BASE_API_URL
});


Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    users: [],
    loading: false,
    displayedUsers: [],
    errors: {},
    message: "",
    paginationIndex: 0
  },
  getters: {
    displayedUsers: state => state.displayedUsers,
    paginationIndex: state => state.paginationIndex,
    users: state => state.users,
    loading: state => state.loading,
    errors: state => state.errors,
    message: state => state.message,
  },
  mutations: {
    SET_USERS(state, users) {
      state.users = users;
      state.loading = false;
    },
    ERROR_GETTING_USERS(state, errors) {
      state.users = [];
      state.loading = false;
      state.errors = errors;
    },
    SET_LOADING_AND_RESET_ERRORS(state, loading) {
      state.loading = loading;
      state.errors = {};
    },
    RESET_MESSAGE(state) {
      state.message = "";
    },
    SET_MESSAGE(state, message) {
      state.message = message;
    },
    SET_LOADING(state, loading) {
      state.loading = loading
    },
    SET_DISPLAYED_USERS(state, payload) {
      state.displayedUsers = state.users.slice(payload.from, payload.to);
      state.paginationIndex = payload.from;
    }
  },
  actions: {
    getAllUsers({commit}) {
      commit('SET_LOADING_AND_RESET_ERRORS', true);

      api.get('/users')
        .then((response) => {
          commit('SET_USERS', response.data.data);
        })
        .catch((errors) => {
          if (errors.response !== undefined) {
            commit('ERROR_GETTING_USERS', errors.response.data);
          } else {
            commit('ERROR_GETTING_USERS', {error: 'Something went wrong :('})
          }
          console.log(errors)
        })
    },

    setMessage({commit}, payload) {
      commit('SET_MESSAGE', payload);
    },
    resetMessage({commit}) {
      setTimeout(() => {
        commit('RESET_MESSAGE');
      }, 4000)
    },
    setLoading({commit}, payload) {
      commit('SET_LOADING', payload);
    },

    setDisplayedUsers({commit}, payload) {
      commit('SET_DISPLAYED_USERS', payload);
    },
  }
});
