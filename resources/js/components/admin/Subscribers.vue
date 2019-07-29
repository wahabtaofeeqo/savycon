<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Subscribers <span class="badge badge-primary">{{ subscribers.length }}</span></h4>
				<p class="category">All your email subscriptions</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="subscribers.length < 1">
					There are no subscribers yet
				</div>
				<div class="table-responsive table-full-width" v-show="subscribers.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(user, index) in subscribers">
								<td>{{ index+1 }}</td>
								<td>{{ user.email }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				subscribers: [],

				url: '/api/subscribers/',
			}
		},
		methods: {
			loadSubscribers() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.subscribers = response.data

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load the subscribers at the moment'
					})

					loader.hide();
				})
			},
		},
		created() {
			this.loadSubscribers();
		},
	}
</script>