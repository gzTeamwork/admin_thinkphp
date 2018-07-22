let Mock = require('mockjs');
//  添加接口拦截
const MockSwitch = false;
if (MockSwitch) {
    Mock.mock(/do\/api_user_login/, 'get', function (ops) {
        console.log(ops)
    });
    Mock.mock(/do\/api_user_login/, 'get', {
        'list|1-10': [{
            'id|+1': 1,
            'email': '@EMAIL'
        }]
    })
}
export default Mock;
