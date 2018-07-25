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
        {
            path: 'publish',
            name: '发布新文章',
            component: () => import('./postPublish'),
        },
        {
            path: 'template',
            name: '文章数据模板',
            component: () => import('./postTemplate'),
        }
    ]
}
