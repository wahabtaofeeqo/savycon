import Vue from 'vue';
import Vuex from 'vuex';


import User from './modules/user';
import Utils from './modules/utils';

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		User,
		Utils,
	}
});