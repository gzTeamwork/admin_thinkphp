export default {
  path: 'post',
  name: '内容',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'list',
      name: '文章列表',
      component: () => import('./postList'),
    },
  ]
}
