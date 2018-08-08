<template>
  <mu-linear-progress v-if="loading"></mu-linear-progress>
</template>

<script>
  export default {
    name: "progressBar",
    data() {
      return {}
    }, props: {
      loading: {
        type: Boolean, default: () => {
          return false
        },
      }
    }, methods: {
      begin() {
        //  开始
        this.loading = true
      },
      end() {
        //  结束
        this.loading = false
      }
    }
  }
</script>

