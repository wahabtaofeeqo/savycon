<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Vendors <span class="badge badge-primary">{{ users.length }}</span></h4>
				<p class="category">All your vendors</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="users.length < 1">
					There are no vendors yet
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
								<th>Services count</th>
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
								<td>{{ user.user_services_count }}</td>
								<td>
									<a :href="showUserServices(user.id)" target="__blank" class="btn btn-sm btn-primary btn-fill" v-if="user.user_services_count > 0">View Services</a>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteUser(user.id)">Delete</button>

									<button class="btn btn-sm btn-warning btn-fill" @click="suspendUser(user.id)" v-if="user.active == 1">Suspend</button>
									<button class="btn btn-sm btn-primary btn-fill" @click="suspendUser(user.id)" v-else>Unsuspend</button>	
								</td>
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
				users: [],
				pagination: {},

				url: '/api/user/',
				loadURL: '/api/users/vendor',
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
						text: 'We could not load the vendors at the moment'
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
                    total_pages: data.total,
                };

                this.pagination = pagination;
            }, 
            fetchPaginateUsers(url) {
                this.loadURL = url;
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

						axios.delete(this.url+'/'+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'Vendor was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshUsers')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the vendor.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			showUserServices(id) {
				return '/services/user/'+id
			},
			suspendUser(id) {
				const loader = this.$loading.show()

            	axios.get('/api/suspend/user/'+id)
            	.then(() => {
            		Swal.fire({
            			type: 'success',
            			title: 'Suspension altered!'
            		})

            		loader.hide()

            		Fire.$emit('refreshUsers')
            	})
            	.catch(() => {
            		Swal.fire({
            			type: 'error',
            			title: 'Oops...',
            			text: 'We could not suspend the vendor at the moment'
            		})

            		loader.hide()
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