<template>
  <mu-container style="width: 300px;">
    <mu-paper :z-depth="1">
      <mu-appbar color="blue400">
        <mu-button icon slot="left">
          <mu-icon value="menu"></mu-icon>
        </mu-button>
        Inforward
      </mu-appbar>
      <com-admin-user-info></com-admin-user-info>
      <mu-divider></mu-divider>
      <!--管理后台菜单-->
      <mu-list toggle-nested>
        <mu-list-item v-for="(e,i) in adminMenu" :key="i" button :ripple="false" nested :open="open === 'send'"
                      @toggle-nested="open = arguments[0] ? 'send' : ''">
          <mu-list-item-action>
            <mu-icon value="send"></mu-icon>
          </mu-list-item-action>
          <mu-list-item-title>{{i}}</mu-list-item-title>
          <mu-list-item-action>
            <mu-icon class="toggle-icon" size="24" value="keyboard_arrow_down"></mu-icon>
          </mu-list-item-action>
          <mu-list-item v-for="(o,n) in e" :key="n" :to="o.path" button :ripple="false" slot="nested">
            <mu-list-item-title>{{o.label}}</mu-list-item-title>
          </mu-list-item>
        </mu-list-item>
      </mu-list>

    </mu-paper>
  </mu-container>
</template>

<script>
  import adminApi from '@/pages/admin/adminApi.js';

  export default {
    name: "adminMenu",
    data() {
      return {
        adminMenu: {},
        open: null,
      }
    },
    created() {
      adminApi.getAdminDashboardMenu();
    },
    computed: {
      handlerAdminMenu: function () {
        return this.$store.getters.getAdminMenu;
      }
    },
    watch: {
      handlerAdminMenu: function (v) {
        this.adminMenu = v;
      }
    },
    components: {
      'com-admin-user-info': () => import('./adminUserInfo.vue'),
    }
  }
</script>

<style scoped>

</style>
