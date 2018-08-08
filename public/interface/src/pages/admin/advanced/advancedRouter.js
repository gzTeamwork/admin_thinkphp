export default {
  path: 'advanced',
  name: '设置',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: '*',
      name: '参数',
      component: () => import('./advancedList'),
    },
  ]
}
