// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from 'vuex'
import App from './App'
import Axios from 'axios'
import router from './router'

import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css';

Vue.use(Vuex);
Vue.use(MuseUI);

Vue.prototype.$http = Axios;

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: {App},
  template: '<App/>'
})
