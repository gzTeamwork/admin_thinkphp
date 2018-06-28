<template>
  <!--顶部导航-->
  <mu-flex>
    <mu-flex>
      <!--左侧菜单-->
      <com-admin-menu></com-admin-menu>
    </mu-flex>
    <mu-flex fill direction="column">
      <com-admin-top-nav></com-admin-top-nav>
      <section id="dashboardMain" class="full-width full-height" style="background:white;">
        <router-view/>
      </section>
    </mu-flex>
  </mu-flex>

</template>

<script>
  import comAdminMenu from '@/pages/admin/components/adminMenu.vue';

  export default {
    name: "dashboard",
    data() {
      return {}
    },
    methods: {},
    created() {
      let domDashMain = document.getElementById('dashboardMain');
      // domDashMain.style = {'height': document.body.clientHeight};
    },
    components: {
      'com-admin-menu': () => import('./components/adminMenu.vue'),
      'com-admin-top-nav': () => import('./components/adminTopNav.vue'),
      // 'com-admin-menu': comAdminMenu
    }
  }
</script>

<style scoped>

</style>
