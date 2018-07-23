<template>
  <mu-container>
    <h2>管理员登陆</h2>

    <template v-if="handlerAdminIsLogin">
      <mu-paper>
        当前已登录用户为
        {{adminUser.nick_name}}
      </mu-paper>
      <mu-button primary @click="adminLoginSubLight">
        快捷登录
      </mu-button>
    </template>

    <mu-form :model="form" :label-position="labelPosition" v-else>

      <!--登录账户-->
      <mu-form-item prop="input" label="管理员账户">
        <mu-text-field v-model="form.account"></mu-text-field>
      </mu-form-item>
      <!--登录密码-->
      <mu-form-item prop="input" label="登录密码">
        <mu-text-field type="password" v-model="form.password"></mu-text-field>
      </mu-form-item>
      <!--是否自动登录-->
      <mu-form-item prop="switch" label="自动登录">
        <mu-switch class="align-center" v-model="form.isAutoLogin"></mu-switch>
      </mu-form-item>

      <mu-flex direction="row" align-items="center" justify-content="center">
        <mu-flex fill></mu-flex>
        <mu-flex direction="column" align="center">
          <mu-button fab color="green300" @click="adminLoginSub">
            <mu-icon value="check"></mu-icon>
          </mu-button>
          <div style="padding:1em;">
            登录
          </div>
        </mu-flex>
        <mu-flex fill></mu-flex>
        <mu-flex direction="column" align="center">
          <mu-button icon color="orange300">
            <mu-icon value="settings_backup_restore"></mu-icon>
          </mu-button>
          <div style="padding:1em;">
            重设
          </div>
        </mu-flex>
        <mu-flex fill></mu-flex>
      </mu-flex>
    </mu-form>
  </mu-container>
</template>

<script>
  import adminApi from '@/pages/admin/adminApi.js';

  export default {
    name: "loginForm",
    data() {
      return {
        labelPosition: 'top',
        adminUser: {},
        form: {
          account: '',
          password: '',
          isAutoLogin: true,
        }
      }
    },
    methods: {
      //  管理员登陆
      adminLoginSub: function (event) {
        return adminApi.adminLoginSub(this.form);
      },
      adminLoginSubLight:function (event) {
        return adminApi.adminLoginSubLight(this.adminUser);
      }
    },
    computed: {
      handlerAdminUser: function () {
        return this.$store.getters.getAdminUser;
      },
      handlerAdminIsLogin: function () {
        return this.$store.getters.isLogin;
      }
    },
    watch: {
      handlerAdminUser: function (v) {
        this.adminUser = v;
      }
    },
  }
</script>

<style scoped>
  div.container {
    padding: 2em;
  }
</style>
