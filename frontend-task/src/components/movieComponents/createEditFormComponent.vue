<template>
  <template>{{ getEditParams($route.params.id) }} </template>
  <div class="signup-form">
      <div class="card card-container">
        <h4 v-if="$route.params.id" class="card-title mb-1 py-2 bg-success text-light">Edit Movie Form</h4>
        <h4 v-if="!$route.params.id" class="card-title mb-1 py-2 bg-success text-light">Create Movie Form</h4>
      <Form
        @submit="handleCreate"
        :validation-schema="schema"
        enctype="multipart/form-data"
      >
        <div>
          <div class="form-group mb-3">
            <div class="input-group align-items-baseline">
              <div class="input-group-prepend">
                <label for="name" class="input-group-text h-100">title</label>
              </div>
              <Field
                name="name"
                type="text"
                class="form-control"
                v-model="name"
              />
            </div>
            <ErrorMessage name="name" class="error-feedback text-danger" />
          </div>
          <div class="form-group mb-3">
            <div class="input-group align-items-baseline">
              <div class="input-group-prepend">
                <label for="description" class="input-group-text h-100"
                  >Description</label
                >
              </div>
              <Field
                name="description"
                type="text"
                class="form-control"
                v-model="description"
              />
            </div>
            <ErrorMessage
              name="description"
              class="error-feedback text-danger"
            />
          </div>
          <div class="form-group mb-3">
            <div class="input-group align-items-baseline">
              <div class="input-group-prepend">
                <label for="image" class="input-group-text h-100">Image</label>
              </div>
              <Field
                name="image"
                type="file"
                class="form-control"
                v-model="image"
              />
            </div>
            <ErrorMessage name="image" class="error-feedback text-danger" />
          </div>
          <div class="form-group mb-3">
            <div class="input-group align-items-baseline">
              <div class="input-group-prepend">
                <label for="category_id" class="input-group-text h-100">Category</label>
              </div>
              <categorySelectComponent :filter="false">
                <template v-slot:errorMsg>
                  <ErrorMessage
                    name="category_id"
                    class="error-feedback text-danger"
                  />
                </template>
              </categorySelectComponent>
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-primary btn-block" :disabled="loading">
              <span
                v-show="loading"
                class="spinner-border spinner-border-sm"
              ></span>
              Save Data
            </button>
          </div>
        </div>
      </Form>

      <div v-if="message && !successful" class="alert alert-danger">
        {{ message }}
      </div>
    </div>
  </div>
</template>

<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import categorySelectComponent from "./categorySelectComponent.vue";
import * as yup from "yup";
import { isEmpty } from "lodash";
export default {
  name: "Register",
  components: {
    Form,
    Field,
    ErrorMessage,
    categorySelectComponent,
  },
  data() {
    var name = "";
    var description = "";
    var image = "";
    var category_id = "";
    var type = "";
    var movie_id = "";
    const schema = yup.object().shape({
      name: yup.string().required("Name is required!"),
      description: yup.string().required("Description is required!"),
      category_id: yup.string().required("Category is required!"),
      image: yup.string().required("Image is required!"),
    });

    return {
      successful: false,
      loading: false,
      message: "",
      schema,
      name,
      description,
      image,
      movie_id,
      type,
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  methods: {
    getEditParams(id) {
      if (!isEmpty(id)) {
        this.$store.dispatch("movie/getMovie", id).then(
          (data) => {
            this.loading = false;
            this.name = data.name;
            this.description = data.description;
            this.image = data.image;
            this.$store.state.movie.selectedCategory = data.category_id;
            this.type = "edit";
            this.movie_id = data.id;
          },
          (error) => {
            this.message =
              (error.response &&
                error.response.data &&
                error.response.data.message) ||
              error.message ||
              error.toString();
            this.loading = false;
          }
        );
      } else {
        this.name = "";
        this.description = "";
        this.image = "";
        this.$store.state.movie.selectedCategory = "select category";
        this.type = "create";
        this.movie_id = "";
      }
    },
    handleCreate(values, actions) {
      this.message = "";
      this.loading = true;
      if (values.category_id == "select category") {
        this.loading = false;
        actions.setFieldError("category_id", "select category from list");
      } else {
        if (this.type == "create") {
          this.$store.dispatch("movie/movieCreated", values).then(
            (data) => {
              this.loading = false;
              if (data.status == "failed") {
                actions.setFieldError("image", data.message.image);
                actions.setFieldError("name", data.message.name);
                actions.setFieldError("description", data.message.description);
                actions.setFieldError("category_id", data.message.category_id);
              } else {
                this.$router.push("/");
              }
            },
            (error) => {
              this.message =
                (error.response &&
                  error.response.data &&
                  error.response.data.message) ||
                error.message ||
                error.toString();
              this.loading = false;
            }
          );
        } else {
          this.$store
            .dispatch("movie/movieUpdated", {
              movie: values,
              id: this.movie_id,
            })
            .then(
              (data) => {
                this.loading = false;
                if (data.status == "failed") {
                  actions.setFieldError("image", data.message.image);
                  actions.setFieldError("name", data.message.name);
                  actions.setFieldError(
                    "description",
                    data.message.description
                  );
                  actions.setFieldError(
                    "category_id",
                    data.message.category_id
                  );
                } else {
                  this.$router.push("/");
                }
              },
              (error) => {
                this.message =
                  (error.response &&
                    error.response.data &&
                    error.response.data.message) ||
                  error.message ||
                  error.toString();
                this.loading = false;
              }
            );
        }
      }
    },
  },
};
</script>

<style scoped>
</style> 