// import axios from 'axios';
import httpAxios from '@/public/http.js';

export default {
  getUserList: function ($num) {
    httpAxios.get('do/api_get_users_list').then(res => {
      if (res.code === 1) {
        window.$store.dispatch('getUserList', res.data);
      }
    })
  }
}
