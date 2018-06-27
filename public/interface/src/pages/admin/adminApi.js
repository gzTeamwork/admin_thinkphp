// import axios from 'axios';
import httpAxios from '@/public/http.js';

export default {
  /**
   * 管理员登陆表单提交
   * @param form
   */
  adminLoginSub: function (form) {
    httpAxios.post('do/api_admin_login', {
      account: form.account || '',
      password: form.password || ''
    }).then(response => {
      if (response.code === 1) {
        //  登录成功,返回管理员信息
        window.$store.commit('NOTICE_SUCCESS', response.msg);
        window.$store.dispatch('adminLoginSuccess', response.data);
      } else {
        window.$store.commit('NOTICE_ERROR', response.msg);
      }
    })
  },
  /**
   * 用户注册表单提交
   * @param form
   */
  userRegisterSub: function (form) {
    httpAxios.post('do/api_user_register', {
      account: form.account || '',
      password: form.password || '',
    }).then(response => {
      if (response.code === 1) {
        //  注册成功
        window.$store.commit('NOTICE_SUCCESS', response.msg);
      } else {
        window.$store.commit('NOTICE_ERROR', response.msg);
      }
    })
  }
}
