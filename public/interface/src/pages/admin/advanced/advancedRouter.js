export default {
  path: 'advanced',
  name: '设置',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'list',
      name: '设置',
      component: () => import('./advancedList'),
    },
  ]
}
