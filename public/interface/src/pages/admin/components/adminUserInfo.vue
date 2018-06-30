<template>
  <mu-list>
    <mu-sub-header>当前用户</mu-sub-header>
    <mu-list-item avatar button :ripple="false">
      <mu-list-item-action>
        <mu-avatar>
        </mu-avatar>
      </mu-list-item-action>
      <mu-list-item-title>{{adminUser.nick_name||'暂无昵称'}}</mu-list-item-title>
      <mu-list-item-action>
        <mu-menu cover placement="bottom-end" :open.sync="adminProfileMenuShow">
          <mu-button icon @click="menuShow">
            <mu-icon value="more_vert"></mu-icon>
          </mu-button>
          <mu-list slot="content">
            <mu-list-item v-for="(e,i) in adminProfileMenu" :key="i" :to="e.path" button>
              <mu-list-item-action>
                <mu-icon v-if="e.icon" class="toggle-icon" size="18" :value="e.icon"></mu-icon>
              </mu-list-item-action>
              <mu-list-item-title>
                <small>{{e.label}}</small>
              </mu-list-item-title>
            </mu-list-item>
          </mu-list>
        </mu-menu>
      </mu-list-item-action>
    </mu-list-item>
  </mu-list>
</template>

<script>
  import adminApi from '@/pages/admin/adminApi.js';

  export default {
    name: "adminUserInfo",
    data() {
      return {
        adminUser: {},
        adminProfileMenu: {},
        adminProfileMenuShow: false,
      }
    },
    mounted() {
      //  初始化用户信息
      this.adminUser = this.$store.getters.getAdminUser;
    },
    watch: {
      handlerAdminUser: function (v) {
        this.adminUser = v;
      },
      handlerAdminProfileMenu: function (v) {
        this.adminProfileMenu = v;
      }
    },
    computed: {
      handlerAdminUser: function () {
        return this.$store.getters.getAdminUser;
      },
      handlerAdminProfileMenu: function () {
        return this.$store.getters.getAdminProfileMenu;
      }
    },
    methods: {
      menuShow: function (event) {
        adminApi.getAdminProfileMenu();
      }
    }

  }
</script>

<style scoped>

</style>
