// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from 'vuex'

import App from './App'
import router from './router'
import store from './store'

//  加载工具库
import _ from 'underscore';

//  加载muse ui
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css';
import theme from 'muse-ui/lib/theme';
import 'muse-ui-loading/dist/muse-ui-loading.css'; // load css
import 'muse-ui-progress/dist/muse-ui-progress.css';
import Loading from 'muse-ui-loading';
import NProgress from 'muse-ui-progress';
import Toast from 'muse-ui-toast';

theme.use('dark');

// 加载上传插件
//  加载cookies插件
import VueCookies from 'vue-cookies'
//  加载axios插件
import Axios from 'axios'
// 加载全局scss
// import '@/assets/scss/main.scss';
import '../static/iconfont/material-icons.css'

import DayJs from 'dayjs'

window.$cookies = VueCookies;
window.$store = store;
window.$day = DayJs;
window.$toast = Toast;

Vue.use(Vuex);
Vue.use(MuseUI);
Vue.use(VueCookies);
Vue.use(NProgress);
Vue.use(Loading);

// Vue.use(Uploader)
Vue.prototype.$http = Axios;
Vue.prototype.$_ = _;
Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router, store,
  components: {App},
  template: '<App/>'
})


