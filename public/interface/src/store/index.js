import Vue from 'vue'
import Vuex from 'vuex'

import adminStore from '@/pages/admin/adminVuex'
import noticeStore from '@/pages/notice/noticeVuex'
import configurationStore from '@/pages/admin/configuration/configurationVuex'

Vue.use(Vuex);

const Store = new Vuex.Store({
  modules: {
    adminStore,
    noticeStore,
    configurationStore,
  }
})

export default Store;
