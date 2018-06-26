/**
 * @file Axios的Vue插件（添加全局请求/响应拦截器）
 */

// https://github.com/mzabriskie/axios
import axios from 'axios'
import config from '@/config';
// console.log(config);

let ajaxAxios = new axios.create({
  baseURL: config.apiServer,
  headers: {'X-Requested-With': 'XMLHttpRequest'},
})

// 拦截request,设置全局请求为ajax请求
ajaxAxios.interceptors.request.use(config => {
  // config.headers['X-Requested-With'] = 'XMLHttpRequest'
  return config
});

// 拦截响应response，并做一些错误处理
ajaxAxios.interceptors.response.use(
  response => {
    console.log('ajax交互完毕' + new Date())
    if (response.status === 200) {
      if (response.code === 0) {
        //  精准的交互失败处理
        console.log('本次ajax数据交互失败,原因是' + response.msg)
      } else {
        return response.data;
      }
    } else {
      const err = new Error(data.description)
      err.data = data
      err.response = response
      throw err
    }
  },
  err => {
    // 这里是返回状态码不为200时候的错误处理
    if (err && err.response) {
      switch (err.response.status) {
        case 400:
          err.message = '请求错误'
          break

        case 401:
          err.message = '未授权，请登录'
          break

        case 403:
          err.message = '拒绝访问'
          break

        case 404:
          err.message = `请求地址出错: ${err.response.config.url}`
          break

        case 408:
          err.message = '请求超时'
          break

        case 500:
          err.message = '服务器内部错误'
          break

        case 501:
          err.message = '服务未实现'
          break

        case 502:
          err.message = '网关错误'
          break

        case 503:
          err.message = '服务不可用'
          break

        case 504:
          err.message = '网关超时'
          break

        case 505:
          err.message = 'HTTP版本不受支持'
          break

        default:
      }
    }

    return Promise.reject(err)
  }
)


export default ajaxAxios;

// axios.install = Vue => {
//   Vue.prototype.$axios = axios
// }


