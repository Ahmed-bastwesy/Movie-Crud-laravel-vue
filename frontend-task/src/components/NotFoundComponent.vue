<template>
  <template>{{ fireWarningSwal() }}</template>
</template>
<script>
export default {
  methods: {
    fireWarningSwal() {
      this.$swal({
        title: "Not found Page",
        // text: "Return to Home page",
        icon: 'error',
        showCancelButton: false,
        confirmButtonText: "Return to Home page",
        showCloseButton: false,
        showLoaderOnConfirm: true,
      }).then((result) => {
            this.$router.push("/");
      });
    },
  },
};
</script>