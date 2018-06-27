// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from 'vuex'
import App from './App'
import router from './router'
import store from './store'

//  加载muse ui
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css';

//  加载cookies插件
import VueCookies from 'vue-cookies'
//  加载axios插件
import Axios from 'axios'
// 加载全局scss
// import '@/assets/scss/main.scss';
import '../static/iconfont/material-icons.css'

window.$cookies = VueCookies;
window.$store = store;

Vue.use(Vuex);
Vue.use(MuseUI);
Vue.use(VueCookies);

Vue.prototype.$http = Axios;

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router, store,
  components: {App},
  template: '<App/>'
})


