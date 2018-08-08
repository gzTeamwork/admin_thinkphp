import httpAxios from '@/public/http.js';
// import './materialApiMock.js';
import Toast from 'muse-ui-toast';

export default {
  async getMaterial(datas) {
    return await httpAxios.get('do/api_get_materials', {params: {...datas}}).then(res => {
      // window.$store.dispatch('getMaterialSuccess', res.data);
      return res.code === 1 ? res.data : [];
    })
  },
  async setMaterial(datas) {
    return await httpAxios.post('do/api_set_materials', {...datas}).then(res => {
      return res.code === 1 ? res.data : [];
    })
  }
}
