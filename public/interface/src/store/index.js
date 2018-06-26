import Vue from 'vue'
import Vuex from 'vuex'

import adminStore from '@/pages/admin/adminVuex'
import noticeStore from '@/pages/notice/noticeVuex'

Vue.use(Vuex);

const Store = new Vuex.Store({
  modules: {
    adminStore,
    noticeStore
  }
})

export default Store;
