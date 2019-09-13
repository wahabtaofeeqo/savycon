<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Buyers <span class="badge badge-primary">{{ pagination.total_items }}</span></h4>
				<p class="category">All your buyers</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="users.length < 1">
					There are no buyers yet
				</div>
				<div class="table-responsive table-full-width" v-show="users.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Phone number</th>
								<th>State</th>
								<th>City</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="user in users">
								<td>{{ user.name }}</td>
								<td>{{ user.email }}</td>
								<td>+234{{ user.phone }}</td>
								<td>{{ user.city.state.name }}</td>
								<td>{{ user.city.name }}</td>
								<td>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteUser(user.id)">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Pagination -->
				<paginate
					:page-count="pagination.last_page || 0"
					:page-range="5"
					:margin-pages="5"
					:click-handler="fetchPaginateUsersWithIndex"
					:prev-text="'Prev'"
					:next-text="'Next'"
					:container-class="'pagination'"
					:page-class="'page-item'">
				</paginate>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				users: [],
				pagination: {},

				url: '/api/user/',
				loadURL: '/api/users/user',
			}
		},
		methods: {
			loadUsers() {
				const loader = this.$loading.show();

				axios.get(this.loadURL)
				.then((response) => {
					this.users = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load the users at the moment'
					})

					loader.hide();
				})
			},
			makePagination(data) {
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    total_items: data.total,
                };

                this.pagination = pagination;
            }, 
            fetchPaginateUsersWithIndex(pageno) {
                this.loadURL = '/api/users/user?page='+pageno;
                this.loadUsers();
            },
			deleteUser(id) {
				Swal.fire({
					title: 'Are you sure?',
					text: 'This action cannot be reverted',
					type: 'warning',
					showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
				})
				.then((result) => {
					if (result.value) {
						const loader = this.$loading.show();

						axios.delete(this.url+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'User was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshUsers')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the user.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
		},
		created() {
			this.loadUsers();

			Fire.$on('refreshUsers', () => {
				this.loadUsers();
			})
		},
		mounted() {

		}
	}
</script>