<template lang="pug">
  div
    login-form
</template>

<script>
  import LoginForm from './LandingPageView/LoginForm'
  export default {
    components: {
      LoginForm
    },
    name: 'landing-page'
  }
</script>

<style scoped>
  
  body {
    background-color: red;
  }
  h1 {
    font-family: 'Oswald', sans-serif;
    font-size: 5rem;
  }
</style>
