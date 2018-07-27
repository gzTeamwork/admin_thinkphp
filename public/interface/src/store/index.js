import Vue from 'vue'
import Vuex from 'vuex'

import noticeModule from '@/pages/notice/noticeVuex'
import configurationModule from '@/pages/admin/configuration/configurationVuex'
import adminModule from '@/pages/admin/adminVuex'
import usersModule from '@/pages/admin/user/userVuex';
import postModule from '@/pages/admin/post/postVuex';
import cateModule from '@/pages/admin/category/cateVuex';
import materialModule from '@/pages/admin/material/materialVuex';

Vue.use(Vuex);

const Store = new Vuex.Store({
  modules: {
    adminModule,
    noticeModule,
    configurationModule,
    usersModule,
    postModule,
    cateModule,
    materialModule
  }
})

export default Store;
