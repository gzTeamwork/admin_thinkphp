<template>
  <section>
    <vue-editor editor="quill2" :height="900">
    </vue-editor>
  </section>
</template>

<script>

  export default {
    name: "postList",
    components: {
      vueEditor: () => import('@/pages/components/editor'),
    },
    data() {
      return {}
    }
    ,
    methods: {}
  }
</script>

<style scoped>

</style>
