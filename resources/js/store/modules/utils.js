const state = () => ({
	flutterwave: "FLWPUBK-3df0eb38dcdc8322952c52b996faa710-X",
});

const getters = {
	getKey: (state, getters) => state.flutterwave
};

const actions = {};

const mutations = {};

export default {
	state,
	getters,
	actions,
	mutations
}