import httpAxios from '@/public/http.js';
import './cateApiMock.js';
import ajaxAxios from "../../../public/http";

export default {
  /**
   * 获取栏目列表
   */
  getCateList: async function () {
    //  第一参数
    return await httpAxios.get('do/api_cates_get', {
      params: {}
    }).then(res => {
      if (res.code === 1) {
        window.$store.dispatch("getCateListSuccess", res.data);
      } else {
      }
      return res.code === 1 ? res.data : [];
    })
  },
  //  增加栏目
  setCateNew: function (form) {
    httpAxios.post('do/api_cate_set', {...form}).then(res => {
      if (res.code === 1) {
        console.log(res);
        window.$store.dispatch("setCateNewSuccess", res.data);
      } else {
      }
    })
  },
  setCateDel: function (form) {
    console.log(form);
    httpAxios.post('do/api_cate_del', {...form}).then(res => {
      if (res.code === 1) {
        this.getCateList();
      }
    })
  }
}
