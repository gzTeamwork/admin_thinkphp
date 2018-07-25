import httpAxios from '@/public/http.js';
import './cateApiMock.js';
import ajaxAxios from "../../../public/http";

export default {
  /**
   * 获取栏目列表
   */
  getCateList: function () {
    //  第一参数
    httpAxios.get('do/api_cates_get', {
      params: {}
    }).then(res => {
      if (res.code === 1) {
        window.$store.dispatch("getCateListSuccess", res.data);
        window.$store.commit("NOTICE_SUCCESS", res.msg);
      } else {
        window.$store.commit("NOTICE_ERROR", res.data.msg);
      }
    })
  },
  setCateNew: function (form) {
    httpAxios.post('do/api_cate_set', {...form}).then(res => {
      if (res.code === 1) {
        console.log(res);
        window.$store.dispatch("setCateNewSuccess", res.data);
        window.$store.commit("NOTICE_SUCCESS", res.msg);
      } else {
        window.$store.commit("NOTICE_ERROR", res.data.msg);
      }
    })
  }
}
