import httpAxios from '@/public/http.js';
// import './postApiMock.js';
import Toast from 'muse-ui-toast';

export default {
  /**
   * 获取多个文章
   * @param form
   */
  getPost: async function (form) {
    await httpAxios.get('do/api_post_get_detail', {
      params: {...form}
    }).then(res => {
      console.log(res);
      if (res.code === 1) {
        window.$store.dispatch('getPostCurrentSuccess', res.data);
      }
      return res.code === 1;
    })
  },
  getPosts: async function (form) {
    await httpAxios.get('do/api_posts_get', {
      params: {...form}
    }).then(res => {
      console.log(res);
      if (res.code === 1) {
        window.$store.commit('NOTICE_SUCCESS', res.msg);
        window.$store.dispatch('getPostListSuccess', res.data);
      } else {
        window.$store.commit('NOTICE_ERROR', res.msg);
      }
      return res.code === 1;
    })
  },
  getPostsList: async function (form) {
    await httpAxios.get('do/api_posts_get_detail', {
      params: {...form}
    }).then(res => {
      console.log(res);
      if (res.code === 1) {
        window.$store.commit('NOTICE_SUCCESS', res.msg);
        window.$store.dispatch('getPostListSuccess', res.data);
      } else {
        window.$store.commit('NOTICE_ERROR', res.msg);
      }
      return res.code === 1;
    })
  },
   setPost: async function (form) {
     return await httpAxios.post('do/api_post_set', {...form}).then(res => {
       console.info(res.msg);
      return res.code === 1;
    })
  },
  setPostDel: async function (form) {
    await httpAxios.post('do/api_post_del', {...form}).then(res => {
      res.code === 1 ? window.$toast.success(res.msg) : window.$toast.error(res.msg);
    })
  },
  getPostTemplates: function (form) {
    httpAxios.get('do/api_post_templates_get', {params: form}).then(res => {
      if (res.code === 1) {
        Toast.success(res.msg)
        window.$store.dispatch('getPostTemplateListSuccess', res.data);
      } else {
        Toast.error(res.msg);
      }
    })
  },
  setPostTemplate: function (form) {
    httpAxios.post('do/api_post_template_set', {...form}).then(res => {
      if (res.code === 1) {
        Toast.success(res.msg)
        window.$store.dispatch('setPostTemplateSuccess', res.data);
      } else {
        Toast.error(res.msg);
      }
    })
  },

}
