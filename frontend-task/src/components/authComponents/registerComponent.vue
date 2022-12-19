<template>
  <div class="signup-form">
    <Form @submit="handleRegister" :validation-schema="schema" class="container">
      <h4 class="card-title mb-1">Welcome to Vue Movies! 👋</h4>
      <p class="card-text mb-2">
        Please sign-up to start the adventure
      </p>
      <div class="form-group my-3">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text h-100">
              <span class="fa fa-user"></span>
            </span>
          </div>
          <Field
            name="username"
            type="text"
            class="form-control"
            placeholder="enter username"
          />
        </div>
        <ErrorMessage name="username" class="error-feedback text-danger" />
      </div>
      <div class="form-group my-3">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text h-100">
              <span class="fa-regular fa-envelope"></span>
            </span>
          </div>
          <Field
            name="email"
            type="email"
            class="form-control"
            placeholder="enter email"
          />
        </div>
        <ErrorMessage name="email" class="error-feedback text-danger" />
      </div>
      <div class="form-group mb-3">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text h-100">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <Field
            name="password"
            type="password"
            class="form-control"
            placeholder="enter password"
          />
        </div>
        <ErrorMessage name="password" class="error-feedback text-danger" />
      </div>
      <div class="form-group">
        <button
          class="btn btn-primary signup-btn btn-block"
          :disabled="loading"
        >
          <span
            v-show="loading"
            class="spinner-border spinner-border-sm"
          ></span>
          <span>Sign Up</span>
        </button>
      </div>
      <div class="form-group">
        <div
          v-if="message && !successful"
          class="alert alert-danger"
          role="alert"
        >
          {{ message }}
        </div>
      </div>
    </Form>
  </div>
  <!-- <div class="col-md-12">
      <div class="card card-container">
        
        <Form @submit="handleRegister" :validation-schema="schema">
          <div >
            <div class="form-group">
              <label for="username">Username</label>
              <Field name="username" type="text" class="form-control" />
              <ErrorMessage name="username" class="error-feedback text-danger" />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <Field name="email" type="email" class="form-control" />
              <ErrorMessage name="email" class="error-feedback text-danger" />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <Field name="password" type="password" class="form-control" />
              <ErrorMessage name="password" class="error-feedback text-danger" />
            </div>
  
            <div class="form-group">
              <button class="btn btn-primary btn-block" :disabled="loading">
                <span
                  v-show="loading"
                  class="spinner-border spinner-border-sm"
                ></span>
                Sign Up
              </button>
            </div>
          </div>
        </Form>
  
        <div
          v-if="message && !successful"
          class="alert alert-danger">
          {{ message }}
        </div>
      </div>
    </div> -->
</template>
  
  <script>
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";

export default {
  name: "Register",
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  data() {
    const schema = yup.object().shape({
      username: yup.string().required("Username is required!"),
      email: yup
        .string()
        .required("Email is required!")
        .email("Email is invalid!"),
      password: yup
        .string()
        .required("Password is required!")
        .min(6, "Must be at least 6 characters!"),
    });

    return {
      successful: false,
      loading: false,
      message: "",
      schema,
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  mounted() {
    if (this.loggedIn) {
      this.$router.push("/");
    }
  },
  methods: {
    handleRegister(user, actions) {
      this.message = "";
      this.loading = true;

      this.$store.dispatch("auth/register", user).then(
        (data) => {
          this.message = data.message;
          this.successful = true;
          this.loading = false;
          if (data.status == "failed") {
            actions.setFieldError("email", data.message.email);
            actions.setFieldError("password", data.message.password);
            actions.setFieldError("username", data.message.name);
          } else {
            this.$router.push("/login");
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
          this.successful = false;
        }
      );
    },
  },
};
</script>
  
  <style >
.signup-form {
  width: 40rem;
  height: 60%;
  margin: 50px auto;
  font-size: 15px;
}
.signup-form Form {
  margin-bottom: 15px;
  background: #f7f7f7;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.signup-form h2 {
  margin: 0 0 15px;
}
.form-control,
.btn {
  min-height: 38px;
  border-radius: 2px;
}
.btn {
  font-size: 15px;
  font-weight: bold;
}
</style> 