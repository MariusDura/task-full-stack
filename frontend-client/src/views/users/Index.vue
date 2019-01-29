<template>
  <div>
    <h1>Users page</h1>
    <div class="table-section col-8 col-md-10 col-sm-11">
      <div v-if="message" class="success-message-field">
        <span>{{message}}</span>
        <hr>
      </div>
      <div v-if="!loading">
        <div class="actions">
          <div class="right-side-actions col-12 col-xs-12">
            <router-link :to="{name: 'userCreate'}" class="spacing success">Create</router-link>
            <router-link :to="{name: 'userImport'}" class="secondary">Import</router-link>
          </div>
        </div>

        <table class="fixed-header" v-if="displayedUsers.length > 0">
          <col class="col-1 col-xs-1">
          <col class="col-4 col-xs-4">
          <col class="col-4 col-xs-4">
          <col class="col-3 col-xs-3">
          <thead>
          <tr>
            <th class="center-text">#</th>
            <th>Name</th>
            <th>Email</th>
            <th class="center-text">Actions</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(user, index) in displayedUsers">
            <td class="center-text">{{rowIndex + 1 + index}}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td class="center-text">
              <router-link :to="{ name: 'userShow', params: { id: user.id }}">
                <font-awesome-icon class="action-icon" icon="eye"/>
              </router-link>
              <router-link :to="{ name: 'userEdit', params: { id: user.id }}">
                <font-awesome-icon class="action-icon" icon="edit"/>
              </router-link>
              <font-awesome-icon class="action-icon" icon="trash" @click="deleteUser(user)"/>
            </td>
          </tr>
          </tbody>
        </table>
        <Pagination v-if="users.length > 0"/>
        <div v-else-if="errors">
          <ul>
            <li v-for="error in errors">
              {{error}}
            </li>
          </ul>
        </div>
        <div v-else>0 users found</div>
      </div>
      <div v-else class="loading-field">
        <img src="../../assets/images/loading-gif.gif">
        <span>Loading</span>
      </div>
    </div>

  </div>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex';
  import {library} from '@fortawesome/fontawesome-svg-core'
  import {faEdit} from '@fortawesome/free-solid-svg-icons';
  import {faTrash} from '@fortawesome/free-solid-svg-icons';
  import {faEye} from '@fortawesome/free-solid-svg-icons';
  import Pagination from '../../components/Pagination';
  import Swal from 'sweetalert2'
  import {BASE_API_URL} from "../../constants";
  import axios from 'axios';

  library.add(faEdit, faTrash, faEye);

  export default {
    components: {
      Pagination
    },
    computed: {
      ...mapGetters({
        users: 'users',
        displayedUsers: 'displayedUsers',
        rowIndex: 'paginationIndex',
        loading: 'loading',
        errors: 'errors',
        message: 'message'
      })
    },
    created() {
      this.getAllUsers();

      if (this.message) {
        this.resetMessage();
      }
    },
    methods: {
      ...mapActions({
        resetMessage: 'resetMessage',
        setMessage: 'setMessage',
        getAllUsers: 'getAllUsers',
        setLoading: 'setLoading'
      }),
      deleteUser(user) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to see '" + user.name + "' again!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0ba519',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          buttonsStyling: true
        }).then((isConfirm) => {
          if (isConfirm.value === true) {
            axios.delete(BASE_API_URL + '/users/' + user.id)
              .then((response) => {
                console.log(response.data);
                if (response.data.Status === 200 && response.data.Status !== undefined) {
                  this.setMessage(response.data.Message);
                  this.getAllUsers();
                  this.resetMessage();
                }
              })
              .catch((error) => {
                console.log(error.response);
              })
          }
        });
      }
    }
  }
</script>
