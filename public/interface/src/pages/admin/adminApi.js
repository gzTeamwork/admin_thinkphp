// import axios from 'axios';
import httpAxios from '@/public/http.js';

// let apiHost = 'http://inforward.localhost.com/inforward/admin/api';
export default {
  adminLoginSub: function (form) {
    httpAxios.post('io/api_admin_login', {
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
  }
}
