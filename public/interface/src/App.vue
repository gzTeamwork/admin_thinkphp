<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
  export default {
    name: 'App'
  }
</script>

<style lang="scss">
  #app {
    /*font-family: 'Avenir', Helvetica, Arial, sans-serif;*/
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    .text {
      &-center {
        text-align: center;
      }
    }
    .align {
      &-center {
        margin: auto;
        &-abs {
          top: 0;
          bottom: 0;
          position: absolute;
          left: 0;
          right: 0;
        }
      }
    }
  }
</style>
