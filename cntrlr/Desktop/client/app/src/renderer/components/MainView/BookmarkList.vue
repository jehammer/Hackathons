<template>
  <div id="links-container">
    <div id="toolbar">
      <div class="ui inverted icon fluid input">
        <input v-model="query" type="text" placeholder="Filter your links...">
        <i class="search icon"></i>
      </div>
    </div>
    <div class="ui relaxed divided selection list">
      <bookmark>
      </bookmark>
    </div>
  </div>
</template>

<script>
  import Bookmark from './Bookmark.vue'
  export default {
    data () {
      return {
        query: ''
      }
    },
    props: ['bookmarks', 'categories'],
    components: {
      Bookmark
    }
  }
</script>