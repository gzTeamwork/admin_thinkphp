import httpAxios from '@/public/http.js';
// import './postApiMock.js';

export default {
  /**
   * 获取多个文章
   * @param form
   */
  getPosts: function (form) {
    httpAxios.get('do/api_posts_get_detail', {
      params: {}
    }).then(res => {
      console.log(res);
      if (res.code === 1) {
        window.$store.commit('NOTICE_SUCCESS', res.msg);
        window.$store.dispatch('getPostSuccess', res.data);
      } else {
        window.$store.commit('NOTICE_ERROR', res.msg);
      }
      return res.code === 1;
    })
  },
  setPost: function (form) {
    httpAxios.post('do/api_post_set', {
      ...form
    }).then(res => {
      console.log(res)
      if (res.code === 1) {
        window.$store.commit("NOTICE_SUCCESS", res.msg);
      } else {
        window.$store.commit("NOTICE_ERROR", res.msg);
      }
      return res.code === 1;
    })
  }
}
