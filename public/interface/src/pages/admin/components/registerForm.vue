<template>
  <mu-container>
    <h2>新用户注册</h2>
    <mu-form ref="userRegisterForm" :model="form" :label-position="labelPosition">
      <!--登录账户-->
      <mu-form-item label="用户登录账号" :rules="rules.account" prop="account">
        <mu-text-field type="text" v-model="form.account" prop="account"></mu-text-field>
      </mu-form-item>
      <!--注册邮箱-->
      <mu-form-item label="用户注册邮箱" :rules="rules.registerEmail" prop="email">
        <mu-text-field type="email" name="mail" v-model="form.email" prop="email"></mu-text-field>
      </mu-form-item>
      <!--登录密码-->
      <mu-form-item prop="password" label="输入登录密码" :rules="rules.password">
        <mu-text-field type="password" prop="password" v-model="form.password"></mu-text-field>
      </mu-form-item>
      <mu-form-item prop="repassword" label="再次输入登录密码" :rules="rules.repassword">
        <mu-text-field type="password" prop="repassword" v-model="form.repassword"></mu-text-field>
      </mu-form-item>
      <mu-form-item prop="isAgree" :rules="rules.isAgree">
        <mu-checkbox v-model="form.isAgree" prop="isAgree" label="同意本站点注册协议" value="是否同意"></mu-checkbox>
      </mu-form-item>
      <mu-flex direction="row" align-items="center" justify-content="center">
        <mu-flex fill></mu-flex>
        <mu-flex direction="column" align="center">
          <mu-button fab color="green300" @click="userRegisterSub">
            <mu-icon value="check"></mu-icon>
          </mu-button>
          <div style="padding:1em;">
            提交注册
          </div>
        </mu-flex>
        <mu-flex fill></mu-flex>
        <mu-flex direction="column" align="center">
          <mu-button icon color="orange300" @click="formClear">
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
  import regexp from '@/public/regexp.js';
  import adminApi from '@/pages/admin/adminApi.js';

  export default {
    name: "registerForm",
    data() {
      return {
        labelPosition: 'top',
        form: {
          account: '',
          password: '',
          repassword: '',
          email: '',
          isAgree: false,
        },
        rules: {
          account: [
            {validate: (val) => !!val, message: '必须填写注册账号!'},
            {validate: (val) => val.length >= 4, message: '注册账号不能少于6个字符!'},
          ],
          registerEmail: [
            {validate: (val) => !!val, message: '必须填写注册邮箱!'},
            {validate: (val) => val.length >= 4, message: '注册邮箱不能少于4个字符!'},
            {validate: (val) => regexp.validEmail(val), message: '请填写正确个格式的邮箱!'}
          ],
          repassword: [
            {validate: (val, model) => val === model.password, message: '请再次输入注册的密码!'}
          ],
          password: [
            {validate: (val) => !!val, message: '请输入注册密码!'},
            {validate: (val) => val.length > 5, message: '注册密码至少需要6位数!'}
          ],
          isAgree: [
            {validate: (val) => val === true, message: '必须同意本站点注册协议'}
          ]
        }
      }
    },
    methods: {
      /**
       * 用户提交事件
       * @param event
       */
      userRegisterSub: function (event) {
        let vm = this;
        this.$refs.userRegisterForm.validate().then((result) => {
          adminApi.userRegisterSub(vm.form);
        });
      },
      /**
       * 清空表单
       */
      formClear: function (event) {
        this.$refs.userRegisterForm.clear();
        this.form = {
          account: '',
          password: '',
          repassword: '',
          email: '',
          isAgree: false,
        };
      },
      /**
       *
       * @param event
       */
      repasswordChange: function (event) {

      }
    },
  }
</script>

<style scoped>

</style>
