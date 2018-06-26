//  a vuex store live template
const state = {
  status: 'default',
  message: '',
};

const getters = {
  getNoticeMessage: state => {
    return state.message;
  },
  getNoticeStatus: state => {
    return state.status;
  }
};

const actions = {};

const mutations = {
  NOTICE_ERROR: function (state, payload) {
    state.status = 'error';
    state.message = payload
  },
  NOTICE_SUCCESS: function (state, payload) {
    state.status = 'success';
    state.message = payload
  }
};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

