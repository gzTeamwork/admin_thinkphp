import config from '@/config';

let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = config.isDev;

// if (MockSwitch) {
//  案例方法
//  Mock.mock('', 'get', function (ops) {
//   console.log(ops)
//  });
//  用户注册
Mock.mock(/api_user_login/, 'get', {
    'code': 1,
    'msg': '用户登录成功',
    'data': {
        'nick_name': 'adminMock',
        'isAdmin': 1,
        'account': "@string()" + '\@' + '@string(2)\.com',
    }
})

//  请求用户菜单
Mock.mock(/api_admin_menu/, {
    'code': 1,
    'msg': '',
    'data': [{
        label: '文章', name: 'post', path: 'post', sub: [
            {label: '文章列表', path: '/admin/post/list'},
            {label: '发布文章', path: '/admin/post/publish'},
            {label: '文章模板', path: '/admin/post/template'},
            {label: '文章回收站', path: '/admin/post/recycle'},
        ],
    }, {
        label: '栏目', name: 'cate', path: 'cate', sub: [
            {label: '栏目列表', path: '/admin/cate/list'},
            {label: '聚合标签', path: '/admin/cate/tags'},
        ]
    }, {
        label: '素材', name: 'material', path: 'material', sub: [
            {label: '素材管理', path: '/admin/material/list'}
        ]
    }]
})

//  请求用户操作菜单
Mock.mock(/api_admin_profile_menu/, {
    'code': 1,
    'msg': '',
    'data': [{label: '登出', url: 'api_admin_logout'}]
})

// }
export default Mock;
