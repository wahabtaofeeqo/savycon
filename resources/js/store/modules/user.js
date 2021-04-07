const state = () => ({
	profile: null
});

const getters = {
	getUser: (state, getters) => {
		return state.profile;
	}
};

const actions = {};

const mutations = {};

export default {
	state,
	getters,
	actions,
	mutations
}