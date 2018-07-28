let Mock = require('mockjs');
let Random = Mock.Random;
Random.extend({
  fileTypes: function (date) {
    let fileType = ['jpg', 'png', 'gif', 'mp3', 'mp4', 'txt', 'php', 'html'];
    return this.pick(fileType);
  }
});

Mock.mock(/api_get_materials/, {
  code: 1,
  msg: '成功获取素材数据',
  data: Mock.mock({
    "array|60": [{
      id: '@increment',
      title: '@ctitle()' + '.' + '@fileTypes',
      type: '@fileTypes',
    }]
  })
})
