import httpAxios from '@/public/http.js';
import './uploaderApiMock'

export default {
  /**
   * 获取多个文章
   * @param file
   * @param url
   * @param $store
   */
  async uploadImg(file, url = null) {
    let result;
    let param = new FormData();
    // 创建form对象
    param.append('img', file);
    param.append('chunk','0');
    // 通过append向form对象添加数据
    // FormData私有类对象，访问不到，可以通过get判断值是否传进去
    console.log(param.get('file'));

    let config = {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'multipart/form-data',
      }
    }; //添加请求头
    await httpAxios.post(url || 'do/api_upload_img', param, config)
      .then(res => {
        console.info('上传文件成功', res.data);
        return result = res.data;
      }).catch(err => {
        console.warn('上传文件失败', err);
      })
    return result
  },
}
