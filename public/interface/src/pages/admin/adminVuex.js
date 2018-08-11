//  a vuex store live template
const state = {
  adminUser: {},
  adminMenu: {},
  adminProfileMenu: {},
};

const getters = {
  //  获取管理后台菜单
  getAdminMenu: state => {
    return state.adminMenu
  },
  //  获取adminUser
  getAdminUser: state => {
    return state.adminUser || false;
  },
  //  是否管理员
  isAdmin: state => {
    return state.adminUser.isAdmin === 1 || false;
  },
  //  是否已经登录
  isLogin: state => {
    return state.adminUser.nick_name || false;
  },
  getAdminProfileMenu: state => {
    return state.adminProfileMenu;
  }
};

const actions = {
  /**
   * 管理后台菜单初始化
   * @param context
   * @param payload
   */
  adminMenuInit: (context, payload) => {
    // console.log(payload);
    state.adminMenu = payload;
  },
  /**
   * 管理员初始化
   * @param context
   * @returns {{}|state.adminUser}
   */
  adminUserInit: (context) => {
    context.commit('COOKIES_ADMIN');
    return state.adminUser;
  },
  /**
   * 管理员登陆成功
   * @param context
   * @param data 传入的参数
   */
  adminLoginSuccess: (context, data) => {
    console.log(data);
    state.adminUser = data;
    state.isAdmin = data.isAdmin || false;
    state.isLogin = true;
    window.$cookies.set('inforward_adminUser', JSON.stringify(data));
    // 成功则跳转到管理后台
    setTimeout(() => {
      location.href = "/admin/dashboard";
    }, 1000)
  },
  /**
   * 当前管理员注销登出
   * @param context
   * @param data
   */
  adminUserLogout: (context, data) => {
    console.log('用户登出');
    window.$cookies.remove('inforward_adminUser');
    setTimeout(() => {
      location.href = "/admin/dashboard";
    }, 1000)
  },
  /**
   * 获取管理后台用户菜单
   * @param context
   * @param data
   */
  getAdminProfileMenu: (context, data) => {
    console.log(data);
    state.adminProfileMenu = data;
  },

};

const mutations = {
    //  从cookie中获取管理员信息
    COOKIES_ADMIN: function (state, payload) {
      let adminUserCookie = window.$cookies.get('inforward_adminUser') || "{}";
      state.adminUser = JSON.parse(adminUserCookie);
      return state.adminUser;
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




