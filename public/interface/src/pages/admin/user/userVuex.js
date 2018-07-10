//  a vuex store live template
const state = {
  userList: {},
  roleList: {},
  roleFields: {},
};

const getters = {
  getUsers: state => {
    return state.userList;
  },
  getRoles: state => {
    return state.roleList;
  }
};

const actions = {
    //  获取用户列表
    getUserList: (context, payload) => {
      state.userList = payload;
    },
    //  获取角色列表
    getRoleList: (context, payload) => {
      state.roleList = payload;
    },
    //  获取角色字段
    getRoleFields: (context, payload) => {
      state.roleFields = payload;
    }
  }
;

const mutations = {};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

