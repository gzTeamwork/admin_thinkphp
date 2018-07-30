import httpAxios from '@/public/http.js';
import './materialApiMock.js';
import Toast from 'muse-ui-toast';

export default {
  async getMaterial(datas) {
    httpAxios.get('/do/api_get_materials', {params: {...datas}}).then(res => {
      window.$store.dispatch('getMaterialSuccess', res.data);
    })
  }
}
