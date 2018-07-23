import Vue from 'vue'
import Vuex from 'vuex'

import noticeStore from '@/pages/notice/noticeVuex'
import configurationStore from '@/pages/admin/configuration/configurationVuex'
import adminStore from '@/pages/admin/adminVuex'
import usersStore from '@/pages/admin/user/userVuex';
import postStore from '@/pages/admin/post/postVuex';

Vue.use(Vuex);

const Store = new Vuex.Store({
  modules: {
    adminStore,
    noticeStore,
    configurationStore,
    usersStore,
    postStore,
  }
})

export default Store;
