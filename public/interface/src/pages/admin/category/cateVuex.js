//  a vuex store live template
//  状态 - 存储数据
const state = {
  rootCate: [{title: '根目录', pid: 0, id: 0, name: 'rootCate'}],
  cateList: []
};
//  获取器 - 获取数据的时候用于处理
const getters = {
  getCateList: () => {
    return state.cateList;
  }
};
//  行动 - 使用 dispatch("event",datas) 触发,用于异步执行
const actions = {
  //  成功获取栏目数据
  getCateListSuccess: (context, datas) => {
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    //  确保第一个是根目录
    state.cateList = state.rootCate.concat(datas);
  },
  //  成功添加新栏目
  setCateNewSuccess: (context, datas) => {
    state.cateList.push(datas);
  }
};
//  变化 - 使用emmit("event",datas) 触发,用于同步执行
const mutations = {};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}
