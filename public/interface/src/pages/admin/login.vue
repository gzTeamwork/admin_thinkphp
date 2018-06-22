<template>
  <mu-flex justify-content="center">
    <mu-flex direction="column" justify-content="start" align-items="center">
      <h2>管理员登陆</h2>
      <mu-form :model="form" :label-position="labelPosition">
        <!--登录账户-->
        <mu-form-item prop="input" label="管理员账户">
          <mu-text-field v-model="form.account"></mu-text-field>
        </mu-form-item>
        <!--登录密码-->
        <mu-form-item prop="input" label="登录密码">
          <mu-text-field v-model="form.password"></mu-text-field>
        </mu-form-item>
        <!--是否自动登录-->
        <mu-form-item prop="switch" label="自动登录">
          <mu-switch v-model="form.isAutoLogin"></mu-switch>
        </mu-form-item>
        <mu-flex direction="row">
          <mu-button color="pink300">新用户</mu-button>
          <mu-button color="primary" @click="adminLoginSub">登录</mu-button>
          <mu-button color="blueGrey100">重填</mu-button>
        </mu-flex>
      </mu-form>
    </mu-flex>
  </mu-flex>
</template>

<script>
  export default {
    name: "login",
    data() {
      return {
        labelPosition: 'top',
        form: {
          account: '',
          password: '',
          isAutoLogin: true,
        }
      }
    },
    methods: {
      adminLoginSub: function () {
        let vm = this;
      }
    }
  }
</script>

<style scoped>
  .mu-button {
    margin: 8px;
  }
</style>
