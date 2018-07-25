import config from '@/config';

let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = config.isDev;

// if (MockSwitch) {
let Random = Mock.Random;
Mock.mock(/api_post_templates_get/, (ops) => {
    let idBegin = parseInt(Math.random() * 100);
    return Mock.mock({
        'code': 1,
        'msg': '[mock]成功获取文章模板列表',
        'data':
            Mock.mock({
                "array|20": [
                    {
                        'id': idBegin + '@increment()',
                        'title': '@ctitle(5,12)',
                        'content': [
                            {title: '租金', name: 'price', value: '@increment', type: 'number'},
                            {title: '面积', name: 'area', value: '@increment', type: 'number'},
                            {
                                title: '标签',
                                name: 'tags',
                                value: Mock.mock({"array|1-10": ['@ctitle(3,6)']}),
                                type: 'array'
                            },
                            {title: '是否已售', name: 'is_sold', value: '@boolean()', type: 'boolean'},
                            {title: '租售到期', name: 'sold_time', value: new Date(), type: 'datetime'},
                            {title: '接盘折扣', name: 'sold_discount', value: 98, type: 'number'},
                            {title: '省', name: 'province', value: '1', type: 'string'},
                            {title: '市', name: 'city', value: '2', type: 'string'},
                            {title: '区', name: 'area', value: '3', type: 'string'},
                            {title: '地址', name: 'address', value: '123', type: 'string'},
                        ],
                        'author': '@name()',
                        'create_time': '@datetime("yyyy-MM-dd HH:mm:ss")',
                        'update_time': '@datetime("yyyy-MM-dd HH:mm:ss")',
                        'thumb': Mock.Random.dataImage('400x200'),
                        'is_active': '@boolean',
                    }
                ]
            })
    })
})
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
