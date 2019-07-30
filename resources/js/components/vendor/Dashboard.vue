<template>
	<div>
		<div class="page-header">Dashboard</div>

		<blockquote v-if="user.active == 0">
			<h1>Your account has been suspended!</h1>
			<h4>Please <a href="/contact" target="__blank">submit a query</a> for the administrator</h4>
		</blockquote>

		<div v-else></div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				user: {},
				url: '/api/profile',
			}
		},
		methods: {
			getUserData() {
				const loader = this.$loading.show()

				axios.get(this.url)
				.then((response) => {
					this.user = response.data

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
		},
		created() {
			this.getUserData()
		},
		mounted() {

		}
	}
</script>