import httpAxios from '@/public/http.js';
import Toast from 'muse-ui-toast';

export default {
  async getAdvanceds(form) {
    return await httpAxios.get('do/api_get_advanceds', {
      params: {...form}
    }).then(res => {
      if (res.code === 1) {
        // window.$store.dispatch('getAdvancedsSuccess', res.datas);
        // window.$cookies.set('website_advanceds', res.datas);
        Toast.success(res.msg);
        return res.data;
      }
    })
  },
  async setAdvanceds(form) {
    return await httpAxios.post('do/api_set_advanceds', {
      ...form
    }).then(res => {
      if (res.code === 1) {
        Toast.success(res.msg);
        return res.data;
      }
    })
  }
}
