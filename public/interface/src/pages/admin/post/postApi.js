import httpAxios from '@/public/http.js';
import './postApiMock.js';

export default {
  getPosts: function (form) {
    httpAxios.get('do/api_post_get', {
      params: {}
    }).then(res => {
      console.log(res);
      if (res.code === 1) {
        window.$store.commit('NOTICE_SUCCESS', res.msg);
        window.$store.dispatch('getPostSuccess', res.data);
        return true;
      } else {
        window.$store.commit('NOTICE_ERROR', res.msg);
        return false;
      }
    })
  }
}
