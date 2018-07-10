<template>
  <div class="full-width">
    <mu-appbar style="width: 100%;" title="Title"></mu-appbar>
    <com-bread-crumbs></com-bread-crumbs>
  </div>
</template>

<script>
  export default {
    name: "adminTopNav",
    components: {
      'com-bread-crumbs': () => import('@/pages/admin/components/breadcrumbs.vue'),
    }
  }
</script>

<style scoped>

</style>
