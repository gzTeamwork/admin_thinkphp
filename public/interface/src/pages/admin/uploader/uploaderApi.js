import httpAxios from '@/public/http.js';
import './uploaderApiMock'

export default {
  /**
   * 获取多个文章
   * @param file
   * @param url
   * @param $store
   */
  async uploadFile(file, url = null) {
    let result;
    let param = new FormData(); //创建form对象
    param.append('file', file);//通过append向form对象添加数据
    // console.log(param.get('file')); //FormData私有类对象，访问不到，可以通过get判断值是否传进去
    let config = {
      headers: {'Content-Type': 'multipart/form-data'}
    }; //添加请求头
    await httpAxios.post(url || 'do/api_upload_file', param, config)
      .then(res => {
        console.info('上传文件成功', res.data);
        window.$store.dispatch('uploadFileSuccess', res.data);
        result = res.data;
      }).catch(err => {
        console.warn('上传文件失败', err);
        // $store.commit('UPLOAD_ERROR', err.data);
      })
    return result
  },
}
