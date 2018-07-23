import Vue from 'vue'
import Router from 'vue-router'
import Store from '@/store'
import AdminRouter from '@/pages/admin/adminRouter'

Vue.use(Router);
const router = new Router({
  mode: 'history',

  routes: [
    AdminRouter
  ]
});
//  总路由守卫,用于检查管理员身份和页面访问权限
router.beforeEach((to, from, next) => {
  Store.dispatch('adminUserInit').then(res => {
    if (res.isAdmin || to.path.match('admin/login')) {
      next()
    } else {
      next('admin/login')
    }
  });
});

export default router;
