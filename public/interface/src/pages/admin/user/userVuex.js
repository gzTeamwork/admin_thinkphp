//  a vuex store live template
const state = {
  users: {}
};

const getters = {
  getUsers: state => {
    return state.users;
  }
};

const actions = {
    getUserList: (context, payload) => {
      state.users = payload;
    }
  }
;

const mutations = {};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

