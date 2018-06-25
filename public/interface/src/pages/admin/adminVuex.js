//  a vuex store live template
const state = {
  adminUser: [],
  isAdmin: false,
  isLogin: false
};

const getters = {
  getAdminUser: state => {
    let adminUser = window.$cookies.get('inforward_adminUser');
  },
  isAdmin: state => {

  }
};

const actions = {
  //  管理员身份初始化
  adminUserInit: (context) => {
    let adminUser = context.commit('COOKIES_ADMIN');
    adminUser || console.log('没有找到adminUser的缓存')
  }
};

const mutations = {
    //  从cookie中获取管理员信息
    COOKIES_ADMIN: function (state, payload) {
      return window.$cookies.get('inforward_adminUser');
    }
  }
;

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

