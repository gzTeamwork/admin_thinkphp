<template>
  <mu-container>
    <mu-flex class="align-center-abs" justify-content="center" align-items="center">
      <mu-flex class="adminLoginBox" direction="column" justify-content="start" align-items="center">
        <mu-tabs :value.sync="tabActive" inverse color="blue300" indicator-color="blue300"
                 text-color="rgba(0, 0, 0, .54)" center>
          <mu-tab>新用户</mu-tab>
          <mu-tab>登录</mu-tab>
          <mu-tab>扫码登录</mu-tab>
        </mu-tabs>
        <!--<transition name="fade">-->
        <com-login-form v-if="tabActive === 1"></com-login-form>
        <com-register-form v-if="tabActive === 0"></com-register-form>
        <!--</transition>-->
      </mu-flex>
    </mu-flex>
  </mu-container>
</template>

<script>
  const LoginForm = () => import("./components/loginForm");
  const RegisterForm = () => import("./components/registerForm");
  export default {
    name: "login",
    data() {
      return {
        tabActive: 1
      };
    },
    methods: {},
    components: {
      "com-login-form": LoginForm,
      "com-register-form": RegisterForm
    }
  };
</script>

<style>
  .adminLoginBox {
    min-height: 680px;
  }
</style>
