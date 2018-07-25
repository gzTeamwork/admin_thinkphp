//  a vuex store live template
//  状态 - 存储数据

const state = {
  postList: [],
  total: 0,
};
//  获取器 - 获取数据的时候用于处理
const getters = {
  getPostsMax: () => {
    return state.postList.total;
  },
  getPosts: () => {
    return state.postList;
  }
};
//  行动 - 使用 dispatch("event",datas) 触发,用于异步执行
const actions = {
  getPostSuccess: (context, datas) => {
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    state.postList = datas;
    state.total = datas.length;
  }
};
//  变化 - 使用emmit("event",datas) 触发,用于同步执行
const mutations = {};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}
