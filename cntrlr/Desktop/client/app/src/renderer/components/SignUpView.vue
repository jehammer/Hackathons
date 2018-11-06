<template lang="pug">
  div
    sign-up
</template>

<script>
  import SignUp from './SignUpView/SignUp'

  export default {
    components: {
      SignUp
    },
    name: 'signup'
  }
</script>

<style scoped>
  h1 {
    font-family: 'Oswald', sans-serif;
    font-size: 5rem;
  }
</style>
