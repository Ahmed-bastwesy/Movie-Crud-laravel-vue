<template>
 
</template>
  
  <script>


export default {
  created() {
      this.$store.dispatch('auth/logout');
      this.$router.push('/login');
  },
};
</script>
  
  <style scoped>
</style>