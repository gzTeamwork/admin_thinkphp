import Vue from 'vue'
import Vuex from 'vuex'

import adminStore from '@/pages/admin/adminVuex'
import noticeStore from '@/pages/notice/noticeVuex'
import configurationStore from '@/pages/admin/configuration/configurationVuex'
import usersStore from '@/pages/admin/user/userVuex';

Vue.use(Vuex);

const Store = new Vuex.Store({
  modules: {
    adminStore,
    noticeStore,
    configurationStore,
    usersStore,

  }
})

export default Store;
