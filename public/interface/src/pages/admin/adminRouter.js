export default {
  path: 'admin',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'login',
      component: () => import('@/pages/admin/login'),
    }
  ]
}
