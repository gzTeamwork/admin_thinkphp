import config from '@/config';

let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = config.isDev;

if (MockSwitch) {
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
      label: '文章', path: 'post', sub: [
        {label: '文章列表', path: '/admin/post/list'},
        {label: '发布文章', path: '/admin/post/publish'},
      ]
    }]
  })

  //  请求用户操作菜单
  Mock.mock(/api_admin_profile_menu/, {
    'code': 1,
    'msg': '',
    'data': [{label: '登出', url: 'api_admin_logout'}]
  })

}
export default Mock;
