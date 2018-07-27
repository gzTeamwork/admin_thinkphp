//  a vuex store live template
//  状态 - 存储数据
const state = {
  materialList: [],

};
//  获取器 - 获取数据的时候用于处理
const getters = {
  getMaterials: state => {
    return state.materialList;
  }
};
//  行动 - 使用 dispatch("event",datas) 触发,用于异步执行
const actions = {
  getMaterialSuccess: function (context, datas) {
    datas = datas.hasOwnProperty('array') ? datas.array : datas;
    state.materialList = datas;
  }
};
//  变化 - 使用emmit("event",datas) 触发,用于同步执行
const mutations = {};

export default {
  state: state, getters: getters, actions: actions, mutations: mutations
}
