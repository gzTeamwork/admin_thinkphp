<template>
  <section>
    {{adminUser.nick_name}}用户登出
  </section>
</template>

<script>
  export default {
    name: "userLogout",
    data() {
      return {
        adminUser: {}
      }
    },
    computed: {
      handlerAdminUser: function () {
        return this.$store.getters.getAdminUser;
      }
    },
    created() {
      // this.adminUser = this.$store.getters.getAdminUser;
      this.$store.dispatch('adminUserLogout');
    }
  }
</script>

<style scoped>

</style>
