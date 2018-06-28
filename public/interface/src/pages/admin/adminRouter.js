export default {
  path: 'admin',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'login',
      name: 'adminLogin',
      component: () => import('@/pages/admin/login'),
    },
    {
      path: '',
      component: () => import('@/pages/admin/dashboard'),
      children: [
        {
          //  系统配置页面
          path: 'configuration',
          component: () => import('@/pages/admin/configuration/configuration.vue')
        },
        {
          //  默认页面
          path: '*',
          component: () => import('@/pages/admin/index'),
        }
      ]
    }
  ]
}
