export default {
  path: 'user',
  name: '用户功能',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'list',
      name: '用户列表',
      component: () => import('./userList'),
    },
    {
      path: 'role',
      name: '权限列表',
      component: () => import('./roleList'),
    }
  ]
}
