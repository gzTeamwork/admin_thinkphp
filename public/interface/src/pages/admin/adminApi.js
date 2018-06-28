// import axios from 'axios';
import httpAxios from '@/public/http.js';

export default {
  /**
   * 管理员登陆表单提交
   * @param form
   */
  adminLoginSub: function (form) {
    httpAxios.get('do/api_user_login', {
      params: {
        account: form.account || '',
        password: form.password || ''
      }
    }).then(response => {
      console.log(response)
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
  },
  /**
   * 获取后台菜单
   */
  getAdminDashboardMenu: function () {
    httpAxios.get('do/api_admin_menu', {
      params: {
        uid: window.$store.getters.adminUid || null
      }
    }).then(response => {
      console.log(response);
      if (response.code === 1) {
        window.$store.dispatch('adminMenuInit', response.data);
      }
    })
  },
  /**
   * 获取系统配置项
   */
  getSystemConfiguration: function () {
    httpAxios.get('do/api_system_configuration', {
      params: {}
    }).then(response => {
      if (response.code === 1) {
        window.$store.dispatch('systemConfigs')
      }
    })
  }
}
