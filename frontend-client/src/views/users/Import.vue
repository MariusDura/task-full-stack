<template>
  <div>
    <h1>User Import</h1>
    <div class="container col-8 col-md-10 col-sm-11 col-xs-12">
      <div class="actions">
        <router-link :to="{name: 'users'}" class="default">Go Back</router-link>
      </div>
      <div class="user-section">
        <div class="information-section">
          <h2>Import information</h2>
          <div class="information">
            <div class="col-12">
              <div class="padding-right">
                <b><label>Link to user:</label></b>
                <input
                  type="text"
                  placeholder="Name..."
                  v-model="importWebsite"
                  :class="{ 'is-invalid': errorMessage }"
                />
                <span v-if="errorMessage" class="error-text">{{errorMessage}}</span>
              </div>
            </div>

          </div>
        </div>


        <button v-if="!loading" type="submit" class="secondary" @click="importUser">Import</button>
        <button v-if="!loading" type="submit" class="purple" @click="importRandomUser">Random Import</button>
        <div v-if="loading">
          <img class="loading-icon" src="../../assets/images/loading-gif.gif" width="40">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapActions} from 'vuex';
  import {BASE_API_URL} from "../../constants";
  import axios from 'axios';
  import router from '../../router';

  export default {
    data() {
      return {
        importWebsite: "https://jsonplaceholder.typicode.com/users",
        errorMessage: "",
        loading: false
      }
    },
    methods: {
      ...mapActions({
        setMessage: 'setMessage'
      }),
      importUser() {
        this.errorMessage = "";
        this.loading = true;
        axios.get(this.importWebsite)
          .then((response) => {
            let user = response.data;
            user['company']['catch_phrase'] = user['company']['catchPhrase'];  //for api user data
            user['imported'] = "true";
            console.log(user);

            axios.post(BASE_API_URL + '/users', user)
              .then((response) => {
                console.log(response);
                if (response.data.Status === 200 && response.data.Status !== undefined) {
                  this.setMessage(response.data.Message);
                  this.loading = false;
                  router.push({name: 'users'});
                }
              })
              .catch((error) => {
                this.errorMessage = "System was not able to import user. Might be a validation error.";
                this.loading = false;
                console.log(error.response);

              });
          })
          .catch((error) => {
            this.errorMessage = "Something wrong happened";
            this.loading = false;
            console.log(error);

          })

      },
      importRandomUser() {
        this.errorMessage = "";
        this.loading = true;
        axios.get('https://jsonplaceholder.typicode.com/users')
          .then((response) => {
            console.log(response);
            let users = response.data;
            let randomUser = users[Math.floor(Math.random() * (users.length - 1))];
            randomUser['company']['catch_phrase'] = randomUser['company']['catchPhrase'];
            randomUser['imported'] = "true";
            console.log(randomUser);

            axios.post(BASE_API_URL + '/users', randomUser)
              .then((response) => {
                console.log(response)
                if (response.data.Status === 200 && response.data.Status !== undefined) {
                  this.setMessage(response.data.Message);
                  router.push({name: 'users'});
                }

                this.loading = false;
              })
              .catch((error) => {
                this.errorMessage = "System was not able to import user. Might be a validation error.";
                console.log(error.response);
                this.loading = false;
              })

          })
          .catch((error) => {
            this.errorMessage = "Something wrong happened";
            this.loading = false;
            console.log(error);

          })

      }
    }
  }


</script>
<style scoped>
  button.secondary, button.purple {
    width: 49%;
  }

</style>
