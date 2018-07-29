import config from '@/config';

let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = config.isDev;

if (config.mockOpen) {
  let Random = Mock.Random;
  Mock.mock(/api_cates_get/, {
    'code': 1,
    'msg': '成功获取栏目列表数据',
    'data':
      Mock.mock({
        "array|20": [
          {
            'id': '@increment',
            'title': '@ctitle(5,12)',
            'pid': '@increment()',
            'create_time': '@datetime("yyyy-MM-dd A HH:mm:ss")',
            'update_time': '@datetime("yyyy-MM-dd A HH:mm:ss")',
            'is_active': '@boolean',
          }
        ]
      })
  })

// new cate api
  Mock.mock(/api_cate_set/, {
    'code': 1,
    'msg': '成功添加新的栏目',
    'data': Mock.mock({
      'id': '@increment',
      'title': '@ctitle(5,12)',
      'pid': '@increment()',
      'create_time': '@datetime("yyyy-MM-dd A HH:mm:ss")',
      'update_time': '@datetime("yyyy-MM-dd A HH:mm:ss")',
      'is_active': '@boolean',
    })
  })
}
