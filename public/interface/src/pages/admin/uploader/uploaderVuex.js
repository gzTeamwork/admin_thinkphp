//  a vuex store live template
//  状态 - 存储数据

const state = {
  uploadFile: null,
  uploadFiles:
    [],
  status:
    'init',
  statusText:
    {
      'init':
        '待上传', 'uploading':
        '上传中', 'success':
        '上传成功', 'error':
        '上传失败',
    }
};
//  获取器 - 获取数据的时候用于处理
const getters = {
  getUploadFile: state => {
    return state.uploadFile;
  },
  getUploadFiles: state => {
    return state.uploadFiles;
  },
  getUploadStatus: state => {
    return state.statusText[state.status] || '其他';
  },
};
//  行动 - 使用 dispatch("event",datas) 触发,用于异步执行
const actions = {
  uploadFileSuccess: (context, datas) => {
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    state.uploadFile = datas;
    state.status = 'success';
  },
  uploadFilesSuccess: (context, datas) => {
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    state.uploadFiles = datas;
  },
};
//  变化 - 使用emmit("event",datas) 触发,用于同步执行
const mutations = {
  "INIT": (state, payload) => {
    state.status = 'init'
  }, "UPLOADING": (state, payload) => {
    state.status = 'uploading'
  }, "UPLOAD_SUCCESS": (state, payload) => {
    state.status = 'success'
  }, "UPLOAD_ERROR": (state, payload) => {
    state.status = 'error'
  },
};

export default {
  state() {
    return {...state}
  }, getters: getters, actions: actions, mutations: mutations
}
