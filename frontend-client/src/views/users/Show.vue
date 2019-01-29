<template>
  <div>
    <h1>{{user.name ? user.name + ' - ' : ''}} Information</h1>

    <div class="container col-10 col-xs-12">
      <div class="actions">
        <router-link :to="{name: 'users'}" class="default">Go Back</router-link>
      </div>
      <div v-if="!loading && !userNotFound" class="user-section">
        <div class="information-section">
          <h2>Main information</h2>
          <div class="information">
            <div class="col-3 col-md-4 col-sm-6 col-xs-12">
              <div class="padding-right">
                <b><label>Name:</label></b>
                <label>{{user.name}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-12">
              <div class="padding-right">
                <b><label>Username:</label></b>
                <label>{{user.username}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-12">
              <div class="padding-right">
                <b><label>Email:</label></b>
                <label>{{user.email}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-12">
              <div class="padding-right">
                <b><label>Phone:</label></b>
                <label>{{user.phone}}</label>
              </div>
            </div>
            <div class="col-12 col-md-4 col-sm-6 col-xs-12">
              <div class="padding-right">
                <b><label>Website:</label></b>
                <label>{{user.website}}</label>
              </div>
            </div>
          </div>
        </div>

        <div class="information-section">
          <h2>Address information</h2>
          <div class="information">
            <div class="col-3 col-md-4 col-sm-6 col-xs-6">
              <div class="padding-right">
                <b><label>Street:</label></b>
                <label>{{user.address.street}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-6">
              <div class="padding-right">
                <b><label>Suite:</label></b>
                <label>{{user.address.suite}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-6">
              <div class="padding-right">
                <b><label>City:</label></b>
                <label>{{user.address.city}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-6">
              <div class="padding-right">
                <b><label>ZipCode:</label></b>
                <label>{{user.address.zipcode}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-6">
              <div class="padding-right">
                <b><label>Geo Lat:</label></b>
                <label>{{user.address.geo.lat}}</label>
              </div>
            </div>
            <div class="col-3 col-md-4 col-sm-6 col-xs-6">
              <div class="padding-right">
                <b><label>Geo Lng:</label></b>
                <label>{{user.address.geo.lng}}</label>
              </div>
            </div>
          </div>
        </div>

        <div class="information-section">
          <h2>Company information</h2>
          <div class="information">
            <div class="col-4 col-md-6 col-sm-6">
              <div class="padding-right">
                <b><label>Name:</label></b>
                <label>{{user.company.name}}</label>
              </div>
            </div>
            <div class="col-4 col-md-6 col-sm-6">
              <div class="padding-right">
                <b><label>Catch Phrase:</label></b>
                <label>{{user.company.catch_phrase}}</label>
              </div>
            </div>
            <div class="col-4 col-md-6 col-sm-6">
              <div class="padding-right">
                <b><label>BS:</label></b>
                <label>{{user.company.bs}}</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else-if="!loading && userNotFound">
        <h3>User not found</h3>
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
  import {BASE_API_URL} from '../../constants';
  import axios from 'axios';

  export default {
    data() {
      return {
        user: {},
        userNotFound: false
      }
    }, computed: {
      ...mapGetters({
        loading: 'loading',
      })
    },
    methods: {
      ...mapActions({
        setLoading: 'setLoading'
      }),
      getUserById(id) {
        this.setLoading(true);
        axios.get(BASE_API_URL + '/users/' + id)
          .then((response) => {
            console.log(response.data);
            this.user = response.data.data;
            this.setLoading(false);
          })
          .catch((error) => {
            console.log(error)
            if (error.response.status === 404) {
              this.userNotFound = true;
            }
            this.setLoading(false);
          })
      }
    },
    created() {
      this.getUserById(this.$route.params.id)
    }
  }
</script>
