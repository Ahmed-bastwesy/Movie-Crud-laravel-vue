<template>
  <div class="col-md-12">
    <div class="p-2 bg-success">
      <div class="input-group mb-3 align-items-baseline border border-1 border-fill-gray rounded mt-2">
      <div class="input-group-prepend">
        <i class="fa-solid fa-magnifying-glass fs-4x fw-bolder mx-1 bg-gray"></i>
      </div>
      <categorySelectComponent :resetSelect="resetSelect" :filter="true"/>
      <button class="btn btn-warning" type="button" id="button-addon2" @click="allMovies(true)" >reset</button>
      </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap">
      <!-- {{ $store.state.movie.movies }} -->
      <div
        class="card my-2 border border-1 border-dark shadow bg-body rounded"
        style="width: 18rem"
        v-for="movie in $store.state.movie.movies"
        :key="movie.id"
      >
        <img
          :src="movie.image ? url + movie.image : logo"
          class="card-img-top"
          style="width: 18rem; height: 12rem"
          alt=""
        />
        <div class="card-body">
          <h5 class="card-title">{{ movie.name }}</h5>
          <p class="card-text text-start" style="text-align: justify">
            {{ movie.description }}
          </p>
        </div>
        <div class="card-footer bg-gray d-flex justify-content-between">
          <router-link :to="'/movie/'+movie.id+'/edit'" class="btn btn-primary">
            edit Movie
          </router-link>
          <a
            href="#"
            class="btn btn-danger"
            @click.prevent="deleteMovie(movie.id)"
            >Delete Movie</a
          >
        </div>
      </div>
      <span v-show="loading" class="spinner-border spinner-border-sm"></span>
    </div>
  </div>
</template>
    
    <script>
import categorySelectComponent from "./categorySelectComponent.vue";
export default {
  name: "Home",

  data() {
    // var movies =  this.$store.state.movie.movies;
    var url = "https://test-api.storexweb.com/";
    return {
      loading: false,
      // movies
      url,
      logo: require("../../assets/logo.png"),
      resetSelect: false,
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  created() {
    if (!this.loggedIn) {
      this.$router.push("/login");
    } else {
      this.loading = true;
      this.allMovies(false);
    }
  },
  methods: {

    allMovies(reset){
      this.$store.dispatch('movie/moviesList').then(
        (data) => {
          this.loading = false;
          this.$store.state.movie.selectedCategory = "select category";
        },
        (error) => {
          this.loading = false;
          this.message =
            (error.response &&
              error.response.data &&
              error.response.data.message) ||
            error.message ||
            error.toString();
        }
        );
    },

    deleteMovie(_id) {
      this.$swal({
        title: "Are you sure?",
        text: "You can't revert your action",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes Delete it!",
        cancelButtonText: "No, Keep it!",
        showCloseButton: true,
        showLoaderOnConfirm: true,
      }).then((result) => {
        if (result.value) {
          this.$store.dispatch("movie/movieDelete", { id: _id }).then(
            (data) => {
              this.$swal(
                "Deleted",
                "You successfully deleted this movie",
                "success"
              );
            },
            (error) => {
              this.$swal("Cancelled", "Your movie is still intact", "info");
              this.message =
                (error.response &&
                  error.response.data &&
                  error.response.data.message) ||
                error.message ||
                error.toString();
            }
          );
        } else {
          this.$swal("Cancelled", "Your movie is still intact", "info");
        }
      });
    },
  },
  components: {
    categorySelectComponent,
  },
};
</script>
    
    <style scoped>
</style>