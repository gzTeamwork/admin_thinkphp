import httpAxios from '@/public/http.js';
import './postApiMock.js';
import Toast from 'muse-ui-toast';

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
                window.$store.dispatch('getPostListSuccess', res.data);
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
    }
}
