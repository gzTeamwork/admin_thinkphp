let Mock = require('mockjs');
let Random = Mock.Random;
Random.extend({
  fileTypes: function (date) {
    let fileType = ['jpg', 'png', 'gif', 'mp3', 'mp4', 'txt', 'php', 'html'];
    return this.pick(fileType);
  }
});


// Mock.mock(/api_upload_file/, (ops) => {
//   console.info('api接口接受参数', ops);
//   return {
//     code: 1,
//     msg: '上传成功',
//     data: Mock.mock({
//       id: '@increment',
//       thumb: Random.dataImage('400x200'),
//       type: '@fileTypes',
//       url: 'https://www.baidu.com/img/bd_logo1.png',
//     })
//   }
// })
