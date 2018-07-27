export default {
  path: 'material',
  name: '素材',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'list',
      name: '素材列表',
      component: () => import('./materialList'),
    },
  ]
}
