import config from '@/config';

let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = config.isDev;

// if (MockSwitch) {
let Random = Mock.Random;
//  案例方法
//  Mock.mock('', 'get', function (ops) {
//   console.log(ops)
//  });
//  用户注册
// Mock.mock(/api_posts_get/, (ops) => {
//   let idBegin = parseInt(Math.random() * 100);
//   return Mock.mock({
//     'code': 1,
//     'msg': '成功获取文章列表',
//     'data':
//       Mock.mock({
//         "array|20": [
//           {
//             'id': idBegin + '@increment()',
//             'title': '@ctitle(5,12)',
//             'content|6': '<p>@cparagraph(10)</p>',
//             'author': '@name()',
//             'create_time': '@datetime("yyyy-MM-dd HH:mm:ss")',
//             'update_time': '@datetime("yyyy-MM-dd HH:mm:ss")',
//             'thumb': Random.dataImage('400x200'),
//             'price': '@increment()',
//             'area': '@increment()',
//             'tags': Mock.mock({"array|1-10": ['@ctitle(3,6)']}),
//             'is_sold': '@boolean()',
//             'sold_time': Random.date(), 'sold_discount': '@increment(2)%',
//             city: '广州',
//             district: '天河',
//             'is_active': '@boolean',
//           }
//         ]
//       })
//   })
// })
// }
