//  a vuex store live template
const state = {
  adminUser: [],
  isAdmin: false,
  isLogin: false
};

const getters = {
  //  获取adminUser
  getAdminUser: state => {
    let adminUser = window.$cookies.get('inforward_adminUser');
    return adminUser
  },
  //  是否管理员
  isAdmin: state => {
    state.isAdmin = adminUser.isAdmin || false
  },
  //  是否已经登录
  isLogin: state => {
    return state.adminUser.nick !== undefined
  }
};

const actions = {
  //  管理员身份初始化
  adminUserInit: (context) => {
    let adminUser = context.commit('COOKIES_ADMIN');
    adminUser || console.log('没有找到adminUser的缓存')
  },
  /**
   * 管理员登陆成功
   * @param context
   * @param data 传入的参数
   */
  adminLoginSuccess: (context, data) => {
    console.log(data);
    window.$cookies.set('inforward_adminUser')
  }
};

const mutations = {
    //  从cookie中获取管理员信息
    COOKIES_ADMIN: function (state, payload) {
      return window.$cookies.get('inforward_adminUser');
    },
    //  管理员成功
    ADMIN_USER_SUCCESS: function (state, payload) {
      state.adminUser = payload;
      window.$cookies.set('inforward_adminUser', JSON.stringify(payload), "1d");
    }
  }
;

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

