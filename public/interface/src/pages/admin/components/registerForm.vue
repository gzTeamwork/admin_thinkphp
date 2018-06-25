<template>
  <mu-container>
    <h2>新用户注册</h2>
    <mu-form :model="form" :label-position="labelPosition">
      <!--登录账户-->
      <mu-form-item prop="input" label="用户登录账号">
        <mu-text-field v-model="form.account"></mu-text-field>
      </mu-form-item>
      <!--注册邮箱-->
      <mu-form-item prop="input" label="用户注册邮箱">
        <mu-text-field type="email" v-model="form.mail"></mu-text-field>
      </mu-form-item>
      <!--登录密码-->
      <mu-form-item prop="input" label="输入登录密码">
        <mu-text-field v-model="form.password"></mu-text-field>
      </mu-form-item>
      <mu-form-item prop="input" label="再次输入登录密码">
        <mu-text-field v-model="form.repassword"></mu-text-field>
      </mu-form-item>
      <mu-flex direction="row" align-items="center" justify-content="center">
        <mu-flex fill></mu-flex>
        <mu-flex direction="column" align="center">
          <mu-button type="submit" fab color="green300" @click="userRegisterSub">
            <mu-icon value="check"></mu-icon>
          </mu-button>
          <div style="padding:1em;">
            提交注册
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
  export default {
    name: "registerForm",
    data() {
      return {
        labelPosition: 'top',
        form: {}
      }
    },
    methods: {
      userRegisterSub: function (event) {

      }
    }
  }
</script>

<style scoped>

</style>
