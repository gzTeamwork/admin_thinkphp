import httpAxios from '@/public/http.js';
import Toast from 'muse-ui-toast';

export default {
  //  看盘预约
  async getBookings(form) {
    return await httpAxios.get('do/api_get_order_booking', {params: {...form}}).then(res => {
      return res.code === 1 ? res.data : [];
    })
  },

  //  公益留言
  async getBenefitDynamic(form) {
    return await httpAxios.get('do/api_get_order_benefit_dynamic', {params: {...form}}).then(res => {
      return res.code === 1 ? res.data : [];
    })
  }
}
