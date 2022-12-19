<template>
  <Field
    as="select"
    @change="selectedCategory"
    class="form-select"
    aria-label="Default select example"
    v-model="$store.state.movie.selectedCategory"
    name="category_id"
  >
    <option selected disabled>select category</option>
    <option
      v-for="category in $store.state.movie.categories"
      :key="category.id"
      :value="category.id"
    >
      {{ category.name }}
    </option>
  </Field>
  <slot name="errorMsg" />
  <span v-show="loading" class="spinner-border spinner-border-sm"></span>
</template>
      
<script>
import { Form, Field, ErrorMessage } from "vee-validate";

export default {
  name: "Home",
  props: ["resetSelect" ,"filter"],
  data() {
    return {
      loading: false,
    };
  },
  components: {
    Field,
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
      this.$store.dispatch("movie/categoriesList").then(
        (data) => {
          this.loading = false;
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
    }
  },
  methods: {
    selectedCategory(e) {
    
      if(this.filter){
        this.$store
          .dispatch("movie/categoryMoviesList", { id: e.target.value })
          .then(
            (data) => {
              //   this.loading = false;
            },
            (error) => {
              //   this.loading = false;
              this.message =
                (error.response &&
                  error.response.data &&
                  error.response.data.message) ||
                error.message ||
                error.toString();
            }
          );
      }
    },
  },
};
</script>
      
      <style scoped>
</style>