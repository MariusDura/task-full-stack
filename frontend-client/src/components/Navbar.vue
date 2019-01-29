<template>
  <nav>
    <div class="navigation" :class="{open:openedNavbar}">
      <div class="navbar-links">
        <div class="logo">
          <img @click="goHome" src="../assets/images/hostinger-logo.png"/>
        </div>
        <div @click="navbarToggle" class="navbar-link-bars navbar-toggle">
          <font-awesome-icon icon="bars"/>
        </div>
      </div>
      <div class="navbar-items" :class="{open:openedNavbar}">
        <router-link active-class="active" exact :to="{name: 'home'}" @click.native="navbarToggleFromLink">Home
        </router-link>
        <router-link active-class="active" :to="{name: 'users'}" @click.native="navbarToggleFromLink">Users
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script>

  import router from '../router';
  import {library} from '@fortawesome/fontawesome-svg-core'
  import {faBars} from '@fortawesome/free-solid-svg-icons';

  library.add(faBars);

  export default {
    data: () => ({
      openedNavbar: false
    }),
    methods: {
      navbarToggle() {
        this.openedNavbar = !this.openedNavbar;
      },
      navbarToggleFromLink() {
        this.openedNavbar = false;
      },
      goHome() {
        this.openedNavbar = false;
        router.push('/');
      }
    }
  }
</script>
<style scoped>
  img:hover {
    cursor: pointer;
  }
</style>
