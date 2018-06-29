//  a vuex store live template
//  系统配置vuex
const state = {
  systemConfigs: {}
};

const getters = {
  /**
   * 返回系统配置
   * @param state
   * @returns {{}|state.systemConfigs}
   */
  getSystemConfigs: state => {
    return state.systemConfigs;
  }
};

const actions = {
  systemConfigs: (context, payload) => {
    context.commit('SYSTEM_CONFIGS', payload);
  }
};

const mutations = {
  SYSTEM_CONFIGS: (state, payload) => {
    console.log(payload);
    state.systemConfigs = payload
  }
};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}

