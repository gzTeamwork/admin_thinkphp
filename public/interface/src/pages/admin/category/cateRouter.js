export default {
  path: 'category',
  name: '栏目',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'list',
      name: '栏目列表',
      component: () => import('./cateList'),
    },
  ]
}
