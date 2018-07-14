// import axios from 'axios';
import httpAxios from '@/public/http.js';

export default {

  //  用户类接口 - user api

  /**
   * 获取用户列表
   */
  getUserList: function () {
    httpAxios.get('do/api_get_user_list').then(res => {
      if (res.code === 1) {
        window.$store.dispatch('getUserList', res.data);
      }
    })
  },

  // 角色类接口 - role api

  /**
   * 获取角色列表
   */
  getRoleList: function () {
    httpAxios.get('do/api_get_role_list').then(res => {
      if (res.code === 1) {
        window.$store.dispatch('getRoleList', res.data);
      }
    })
  },

  /**
   * 获取角色字段
   */
  getNewRoleFields: function () {
    httpAxios.get('do/api_get_role_fields').then(res => {
      if (res.code === 1) {
        window.$store.dispatch('getRoleFields', res.data);
      }
    })
  },

  /**
   * 提交增加新的权限角色
   * @param data
   */
  newRoleSub: function (data) {
    httpAxios.get('do/api_set_new_role', {
      params: {...data}
    }).then(response => {
      if (response.code === 1) {
        // 成功
        window.$store.commit('NOTICE_SUCCESS', response.msg);
      } else {
        //  失败
        window.$store.commit('NOTICE_ERROR', response.msg);
      }
    })
  }
}
