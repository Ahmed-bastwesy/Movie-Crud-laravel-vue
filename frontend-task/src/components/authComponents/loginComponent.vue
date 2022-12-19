<template>
  <!-- <div class="col-md-12"> -->
  <div class="login-form">
    <Form @submit="handleLogin" :validation-schema="schema" class="container">
      <h4 class="card-title mb-1">Welcome to Vue Movies! 👋</h4>
      <p class="card-text mb-2">
        Please sign-in to your account and start the adventure
      </p>
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
        <button class="btn btn-primary login-btn btn-block" :disabled="loading">
          <span
            v-show="loading"
            class="spinner-border spinner-border-sm"
          ></span>
          <span>Sign in</span>
        </button>
      </div>
      <div class="form-group">
        <div v-if="message" class="alert alert-danger" role="alert">
          {{ message }}
        </div>
      </div>
    </Form>
  </div>

</template>
  
  <script>
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";

export default {
  name: "Login",
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  data() {
    const schema = yup.object().shape({
      email: yup
        .string()
        .email("Email is invalid!")
        .required("Email is required!"),
      password: yup.string().required("Password is required!"),
    });

    return {
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
  created() {
    if (this.loggedIn) {
      this.$router.push("/");
    }
  },
  methods: {
    handleLogin(user, actions) {
      this.loading = true;
      this.$store.dispatch("auth/login", user).then(
        () => {
          this.$router.push("/");
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
  },
};
</script>
  
  <style scoped>
.login-form {
  width: 40rem;
  height: 60%;
  margin: 50px auto;
  font-size: 15px;
}
.login-form Form {
  margin-bottom: 15px;
  background: #f7f7f7;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h2 {
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