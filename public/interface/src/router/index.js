import Vue from 'vue'
import Router from 'vue-router'
import AdminRouter from '@/pages/admin/adminRouter'

Vue.use(Router);
export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'adminIndex',
      component: {
        template: '<router-view/>'
      },
      children: [AdminRouter]
    }
  ]
})
