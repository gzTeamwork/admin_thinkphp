<template>
  <div id="app">
    <com-tips></com-tips>
    <router-view/>
  </div>
</template>

<script>
  export default {
    name: 'App',
    components: {
      'com-tips': () => import('@/pages/notice/notice.vue'),
    }
  }
</script>

<style lang="scss">
  #app {
    /*font-family: 'Avenir', Helvetica, Arial, sans-serif;*/
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    .full {
      &-width {
        width: 100%;
      }
      &-height {
        height: 100%;
      }
    }
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
