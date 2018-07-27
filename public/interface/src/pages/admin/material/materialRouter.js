export default {
    path: 'material',
    name: '素材',
    component: {
        template: '<router-view/>'
    },
    children: [
        {
            path: 'list',
            name: '文章列表',
            component: () => import('./materialList'),
        },
    ]
}
