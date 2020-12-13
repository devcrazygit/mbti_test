const RESULT_KEY = 'perspective';

const state = {
  result : null,
}
const getters = {
  result(state){
    var res = localStorage.getItem(RESULT_KEY);
    if(res){
      return JSON.parse(res);
    }else{
      return null;
    }
  }
}
const mutations = {
  
};

const actions = {
  clearResult({commit, dispatch}) {
    localStorage.setItem(RESULT_KEY, "");
  },
  saveResult({commit, dispatch}, payload){
    localStorage.setItem(RESULT_KEY, JSON.stringify(payload));
  },
};



const results = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};

export default results;