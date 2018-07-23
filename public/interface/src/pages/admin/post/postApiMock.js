import config from '@/config';

let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = config.isDev;

if (MockSwitch) {
  let Random = Mock.Random;
  //  案例方法
  //  Mock.mock('', 'get', function (ops) {
  //   console.log(ops)
  //  });
  //  用户注册
  Mock.mock(/api_post_get/, (ops) => {
    let idBegin = parseInt(Math.random() * 100);
    return Mock.mock({
      'code': 1,
      'msg': '成功获取文章列表',
      'data':
        Mock.mock({
          "array|100": [
            {
              'id': idBegin + '@increment',
              'title': '@ctitle(5,12)',
              'content|6': '<p>@cparagraph(10)</p>',
              'author': '@name()',
              'create_time': '@datetime("yyyy-MM-dd A HH:mm:ss")',
              'update_time': '@datetime("yyyy-MM-dd A HH:mm:ss")',
              'thumb': Random.dataImage(),
              'isActive': '@boolean',
            }
          ]
        })
    })
  })
}
