<template>
  <mu-paper class="full-width" :z-depth="1">
    <!--<mu-appbar style="width: 100%;" title="Title"></mu-appbar>-->
    <com-bread-crumbs></com-bread-crumbs>
  </mu-paper>
</template>

<script>
  export default {
    name: "adminTopNav",
    components: {
      'com-bread-crumbs': () => import('@/pages/admin/components/breadcrumbs.vue'),
    }
  }
</script>

<style lang="scss" scoped>

</style>
