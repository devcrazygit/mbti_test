import Vue from 'vue';
import Vuex from 'vuex';

import alerts from './modules/alerts-module'
import result from './modules/result-module'
import auth from './modules/auth-module'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth,
    alerts,
    result,
  }
});
