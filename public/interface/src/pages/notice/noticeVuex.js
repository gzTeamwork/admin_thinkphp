//  a vuex store live template
const state = {
  status: 'default',
  message: '',
  timestamp: null,
};

const getters = {
  getNoticeMessage: state => {
    return state.message;
  },
  getNoticeStatus: state => {
    return state.status;
  },
  getNoticeTimeStamp: state => {
    return state.timestamp;
  }
};
//  异步执行 - dispatch
const actions = {

};
//  同步执行 - commit
const mutations = {
  //  错误消息
  NOTICE_ERROR: function (state, payload) {
    state.status = 'error';
    state.message = payload;
    state.timestamp = new Date();
  },
  //  正确消息
  NOTICE_SUCCESS: function (state, payload) {
    state.status = 'success';
    state.message = payload;
    state.timestamp = new Date();
  }
};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

