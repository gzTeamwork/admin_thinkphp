//  a vuex store live template
//  状态 - 存储数据

const state = {
  postList: [],
  postTemplateList: [],
  postCurrent: {},
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
  , getPostTemplates: () => {
    return state.postTemplateList;
  },
  getPostTemplate: (postTempName) => {
    state.postTemplateList.map((e, i) => {
      return e.name === postTempName ? e : [];
    })
  },
  getPostCurrent: () => {
    return state.postCurrent;
  }
};
//  行动 - 使用 dispatch("event",datas) 触发,用于异步执行
const actions = {
  setPostTemplateSuccess: (context, datas) => {
    state.postTemplateList.push(datas);
  },
  getPostTemplateListSuccess: (context, datas) => {
    // console.log(datas);
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    state.postTemplateList = datas;
  },
  getPostListSuccess: (context, datas) => {
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    state.postList = datas;
    state.total = datas.length;
  },
  getPostCurrentSuccess: (context, datas) => {
    datas.create_time = new Date(datas.create_time);
    datas.update_time = new Date(datas.update_time);
    state.postCurrent = {...datas}
  }

};
//  变化 - 使用emmit("event",datas) 触发,用于同步执行
const mutations = {};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}
