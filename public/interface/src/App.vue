<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
  export default {
    name: 'App',
    components: {}, methods: {}, mounted() {
    }
  }
</script>

<style lang="scss">
  $orientations: ('bottom', 'top', 'left', 'right');
  $colors: ('black':#2c3e50, 'white':#ffffff);
  #app {
    @each $e in $colors {
      $i: index($colors, $e);
      .#{$i} {
        background: #{$e};
      }
    }
    .cms {
      &-stick {
        height: 64px;
        & > .bar {
          position: fixed;
          height: 64px;
          @extend .full-width;
          @for $i from 1 through length($orientations) {
            $item: nth($orientations, $i);
            &.#{$item} {
              #{$item}: 0;
            }
          }
        }
      }
    }
    .gutter {
      padding: 1em;
      width: 100%;
    }
    /*font-family: 'Avenir', Helvetica, Arial, sans-serif;*/
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    /*text-align: center;*/
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
    .fixed {
      position: fixed;
      z-index: 10;
    }
    .abs {
      &-body {
        position: relative;
        overflow: hidden;
      }
      &-item {
        position: absolute;
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
