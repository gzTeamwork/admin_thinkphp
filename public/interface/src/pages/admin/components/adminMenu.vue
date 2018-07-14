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
        <mu-list-item v-for="(e,i) in adminMenu" :key="i" button :ripple="false" nested
                      :open="open === e.name"
                      @toggle-nested="open = arguments[0] ? e.name : ''">
          <mu-list-item-action>
            <mu-icon v-if="e.icon" class="toggle-icon" size="24" :value="e.icon"></mu-icon>
          </mu-list-item-action>
          <mu-list-item-title>{{e.label}}</mu-list-item-title>
          <mu-list-item-action>
            <mu-icon class="toggle-icon" size="24"
                     :value="open === e.name?'keyboard_arrow_down':'keyboard_arrow_left'"></mu-icon>
          </mu-list-item-action>
          <mu-list-item v-for="(o,n) in e.sub" :key="n" :to="o.path" button :ripple="false" slot="nested"
                        :class="currentMenu === o.path?'isActive':''"
                        @click="menuClick">
            <mu-list-item-title>
              <small>{{o.label}}</small>
            </mu-list-item-title>
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
        currentMenu: null,
      }
    },
    created() {
      adminApi.getAdminDashboardMenu();
      this.currentMenu = this.$route.path;
    },
    computed: {
      handlerAdminMenu: function () {
        return this.$store.getters.getAdminMenu;
      }
    },
    watch: {
      handlerAdminMenu: function (v) {
        this.adminMenu = v;
      },
      '$route.path': function (v) {
        this.currentMenu = v;
      }
    },
    components: {
      'com-admin-user-info': () => import('./adminUserInfo.vue'),
    },
    methods: {
      menuClick: function (event) {

      }
    }
  }
</script>

<style lang="scss" scoped>
  .isActive {
    position: relative;
    &::before, &::after {
      content: ' ';
      width: 6px;
      height: 100%;
      position: absolute;
      background: #999;
    }
    &::after {
      right: 0;
      top: 0;
    }
  }
</style>
