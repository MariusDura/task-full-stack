<template>
  <div>
    <h1>{{ userName ? userName + ' - ' : ''}} User Edit</h1>
    <div class="container col-10 col-xs-12">
      <div class="actions">
        <router-link :to="{name: 'users'}" class="default">Go Back</router-link>
      </div>
      <div v-if="!loading && !userNotFound" class="user-section">
        <form @submit.prevent="editUser">
          <div class="information-section">
            <h2>Main information</h2>
            <div class="information">
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Name:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('name') }"
                         type="text"
                         placeholder="Name..."
                         v-model="form.name"
                  />
                  <span v-if="form.errors.has('name')" class="error-text">{{form.errors.get('name')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Username:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('username') }"
                         type="text"
                         placeholder="Username..."
                         v-model="form.username"
                  />
                  <span v-if="form.errors.has('username')" class="error-text">{{form.errors.get('username')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Email:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('email') }"
                         type="text"
                         placeholder="Email..."
                         v-model="form.email"
                  />
                  <span v-if="form.errors.has('email')" class="error-text">{{form.errors.get('email')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Phone:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('phone') }"
                         type="text"
                         placeholder="Phone..."
                         v-model="form.phone"
                  />
                  <span v-if="form.errors.has('phone')" class="error-text">{{form.errors.get('phone')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Website:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('website') }"
                         type="text"
                         placeholder="Website..."
                         v-model="form.website"
                  />
                  <span v-if="form.errors.has('website')" class="error-text">{{form.errors.get('website')}}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="information-section">
            <h2>Address information</h2>
            <div class="information">
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Street:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('address.street') }"
                         type="text"
                         placeholder="Street..."
                         v-model="form.address.street"
                  />
                  <span v-if="form.errors.has('address.street')" class="error-text">{{form.errors.get('address.street')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>Suite:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('address.suite') }"
                         type="text"
                         placeholder="Suite..."
                         v-model="form.address.suite"
                  />
                  <span v-if="form.errors.has('address.suite')"
                        class="error-text">{{form.errors.get('address.suite')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>City:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('address.city') }"
                         type="text"
                         placeholder="City..."
                         v-model="form.address.city"
                  />
                  <span v-if="form.errors.has('address.city')"
                        class="error-text">{{form.errors.get('address.city')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-12">
                <div class="padding-right">
                  <b><label>ZipCode:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('address.zipcode') }"
                         type="text"
                         placeholder="ZipCode..."
                         v-model="form.address.zipcode"
                  />
                  <span v-if="form.errors.has('address.zipcode')" class="error-text">{{form.errors.get('address.zipcode')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-6">
                <div class="padding-right">
                  <b><label>Geo Lat:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('address.geo.lat') }"
                         type="text"
                         placeholder="Geo Lat..."
                         v-model="form.address.geo.lat"
                  />
                  <span v-if="form.errors.has('address.geo.lat')" class="error-text">{{form.errors.get('address.geo.lat')}}</span>
                </div>
              </div>
              <div class="col-3 col-md-4 col-sm-6 col-xs-6">
                <div class="padding-right">
                  <b><label>Geo Lng:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('address.geo.lng') }"
                         type="text"
                         placeholder="Geo Lng..."
                         v-model="form.address.geo.lng"
                  />
                  <span v-if="form.errors.has('address.geo.lng')" class="error-text">{{form.errors.get('address.geo.lng')}}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="information-section">
            <h2>Company information</h2>
            <div class="information">
              <div class="col-4 col-md-6 col-sm-12">
                <div class="padding-right">
                  <b><label>Name:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('company.name') }"
                         type="text"
                         placeholder="Name..."
                         v-model="form.company.name"
                  />
                  <span v-if="form.errors.has('company.name')"
                        class="error-text">{{form.errors.get('company.name')}}</span>
                </div>
              </div>
              <div class="col-4 col-md-6 col-sm-12">
                <div class="padding-right">
                  <b><label>Catch Phrase:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('company.catch_phrase') }"
                         type="text"
                         placeholder="Catch Phrase..."
                         v-model="form.company.catch_phrase"
                  />
                  <span v-if="form.errors.has('company.catch_phrase')" class="error-text">{{form.errors.get('company.catch_phrase')}}</span>
                </div>
              </div>
              <div class="col-4 col-md-6 col-sm-12">
                <div class="padding-right">
                  <b><label>BS:</label></b>
                  <input :class="{ 'is-invalid': form.errors.has('company.bs') }"
                         type="text"
                         placeholder="BS..."
                         v-model="form.company.bs"
                  />
                  <span v-if="form.errors.has('company.bs')" class="error-text">{{form.errors.get('company.bs')}}</span>
                </div>
              </div>
            </div>
          </div>
          <button v-if="!form.busy" type="submit" class="success">Save</button>
          <div>
            <img class="loading-icon" v-if="form.busy" src="../../assets/images/loading-gif.gif" width="40">
          </div>
        </form>
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
  import {Form} from 'vform';
  import {BASE_API_URL} from "../../constants";
  import router from '../../router';
  import axios from 'axios';

  export default {
    data() {
      return {
        form: {},
        userId: "",
        userName: "",
        userNotFound: false
      }
    },
    computed: {
      ...mapGetters({
        loading: 'loading',
      })
    },
    methods: {
      ...mapActions({
        setMessage: 'setMessage',
        setLoading: 'setLoading'
      }),
      getUserById(id) {
        this.setLoading(true);
        axios.get(BASE_API_URL + '/users/' + id)
          .then((response) => {
            console.log(response.data);
            this.form = new Form(response.data.data);
            this.userName = response.data.data.name;
            this.setLoading(false);
          })
          .catch((error) => {
            console.log(error);
            if (error.response.status == 404) {
              this.userNotFound = true;
            }
            this.setLoading(false);
          })
      },
      editUser() {
        this.form.put(BASE_API_URL + '/users/' + this.userId)
          .then((response) => {
            console.log(response);
            if (response.data.Status === 200 && response.data.Status !== undefined) {
              this.form.busy = true;
              this.setMessage(response.data.Message);

              setTimeout(() => {
                this.form.busy = false;
                router.push({name: 'users'});
              }, 1000)
            }
          })
          .catch((error) => {
            console.log(error.response);
          })
      }
    }
    ,
    created() {
      this.getUserById(this.$route.params.id)
      this.userId = this.$route.params.id;
    }
  }
</script>
