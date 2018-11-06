<template lang="pug">
div
  .ui.grid
    side-bar
    router-view
</template>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css');
@import url('https://fonts.googleapis.com/css?family=Raleway:300,400');

div.ui.grid {
    margin: 0!important;
}

div {
    width: 100%;
    height: 100%;
}
</style>

<script>
  import SideBar from './MainView/SideBar.vue'

  export default {
    components: {
      SideBar
    }
  }

</script>