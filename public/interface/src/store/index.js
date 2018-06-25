import Vue from 'vue'
import Vuex from 'vuex'

import adminStore from '@/pages/admin/adminVuex'

Vue.use(Vuex);

const Store = new Vuex.Store({
  modules: {
    adminStore
  }
})

export default Store;
