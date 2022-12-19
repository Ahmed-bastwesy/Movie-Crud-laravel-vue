<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
  </nav>
  <router-view/> -->
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3" >
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand">
          <img src="../src/assets/logo.png" height="28" alt="CoolBrand" />
        </router-link>
        <button
          type="button"
          class="navbar-toggler"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div v-if="!currentUser" class="navbar-nav ml-auto">
            welcome at vue3 movies
          </div>

          <div v-if="currentUser" class="navbar-nav">
            <router-link to="/" class="nav-item nav-link active"> Movies List </router-link>
            <router-link to="/movie/create" class="nav-item nav-link "> Create Movie</router-link>
          </div>
          <div class="navbar-nav ms-auto">
            <div v-if="!currentUser" class="navbar-nav ml-auto">
              <li class="nav-item">
                <router-link to="/login" class="nav-link btn btn-outline-success mx-2"> login </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/register" class="nav-link btn btn-outline-primary">
                  register
                </router-link>
              </li>
            </div>
            <div v-if="currentUser" class="navbar-nav ml-auto">
              <li class="nav-item">
                <router-link to="/logout" class="nav-link btn btn-outline-danger">
                  LogOut
                </router-link>
              </li>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="container">
      <router-view />
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    currentUser() {
      return this.$store.state.auth.user;
    },
  },
  methods: {},
};
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
body, html { 
  background: linear-gradient(to bottom,black, #ced5dc) no-repeat center center fixed; 
  background-size: cover;
  height: 100%;
}
</style>
