<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					Vendors <span class="badge badge-primary">{{ pagination.total_items }}</span>

					<div class="pull-right">
						<input type="text" name="search" class="form-control" v-model="search" placeholder="Search by name or email..." @input="searchVendor" @keyup.enter="searchVendor">
					</div>
				</h4>
				<p class="category">All your vendors</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="users.length < 1">
					There are no vendors yet
				</div>
				<!-- List -->
				<div v-show="!editmode">
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
										<a :href="showUserServices(user.id)" target="__blank" class="btn btn-sm btn-primary btn-fill" v-if="user.user_services_count > 0">View</a>
										<button class="btn btn-sm btn-info btn-fill" @click="editUser(user)">Edit</button>
										<button class="btn btn-sm btn-danger btn-fill" @click="deleteUser(user.id)">Delete</button>

										<button class="btn btn-sm btn-warning btn-fill" @click="suspendUser(user.id)" v-if="user.active == 1">Suspend</button>
										<button class="btn btn-sm btn-primary btn-fill" @click="suspendUser(user.id)" v-else>Unsuspend</button>	
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<!-- Pagination -->
					<div class="paginator btn-group">
						<button class="btn btn-fill btn-primary" @click="fetchPaginateUsers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" v-show="pagination.prev_page_url">
							<i class="fa fa-arrow-left"></i> Prev
						</button>

						<button class="btn btn-fill btn-default" @click="fetchPaginateUsersWithIndex(pageno)" v-for="pageno in pagination.last_page" :disabled="pageno == pagination.current_page" :key="pageno" v-show="pagination.last_page > 1">
							{{ pageno }}
						</button>

						<button class="btn btn-fill btn-primary pull-right" @click="fetchPaginateUsers(pagination.next_page_url)" :disabled="!pagination.next_page_url" v-show="pagination.next_page_url">
							Next <i class="fa fa-arrow-right"></i>
						</button>

						<div class="clearfix"></div>
					</div>
				</div>

				<!-- Edit -->
				<div v-show="editmode">
					<alert-error :form="form"></alert-error>

					<form method="POST" @submit.prevent="updateUser()" @keydown="form.onKeydown($event)">
						<div class="form-group">
                        	<label for="name">Full name</label>
                            <input v-model="form.name" type="text" name="name" placeholder="Full name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" id="name" required>
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                        	<label for="email">Email address</label>
                            <input v-model="form.email" type="email" name="email" placeholder="Email address" class="form-control" :class="{ 'has-error':form.errors.has('email') }" id="email" required>
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                        	<label for="phone">Phone number</label>
                            <div class="input-group">
                            	<div class="input-group-addon" id="addon-phone">+234</div>
                            	<input v-model="form.phone" type="tel" name="phone" placeholder="Phone number" class="form-control" :class="{ 'has-error':form.errors.has('phone') }" id="phone" aria-describedby="addon-phone" minlength="10" maxlength="10" required>
                            </div>
                            <has-error :form="form" field="phone"></has-error>
                        </div>
                        <div class="form-group">
                        	<label for="password">Password</label>
                        	<div class="input-group">
                            	<input v-model="form.password" type="password" name="password" placeholder="Enter a password" class="form-control" :class="{ 'has-error':form.errors.has('password') }" id="password">
                            	<div class="input-group-btn">
                            		<button class="btn btn-default" type="button" @click="generatePassword">{{ generatedPassword ? 'Copied to Clipboard' : 'Auto-Generate Password' }}</button>
                            	</div>
                            </div>
                            <small class="help-block text-primary"><i class="fa fa-info-circle"></i> Ignore if you do not want to change the password</small>
                            <has-error :form="form" field="password"></has-error>
                        </div>

						<button type="submit" :disabled="form.busy" class="btn btn-fill btn-primary">Update User</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				editmode: false,
				generatedPassword: false,

				users: [],
				pagination: {},

				form: new Form({
					id: '',
					name: '',
					email: '',
					phone: '',
					password: '',
					city: {
						id: '',
						state: {
							id: ''
						}
					}
				}),

				search: '',

				url: '/api/user/',
				loadURL: '/api/users/vendor/',
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
                    total_items: data.total,
                };

                this.pagination = pagination;
            }, 
            fetchPaginateUsers(url) {
                this.loadURL = url;
                this.loadUsers();
            },
            fetchPaginateUsersWithIndex(pageno) {
                this.loadURL = '/api/users/vendor?page='+pageno;
                this.loadUsers();
            },
            searchVendor() {
            	setTimeout(() => {
            		axios.get('/api/findAdminVendor/'+this.search)
	            	.then((response) => {
	            		this.users = response.data.data

	            		this.makePagination(response.data)
	            	})
	            	.catch(() => {
	            		Toast.fire({
	            			type: 'error',
	            			title: 'Search does not exist',
	            		})
	            	})
            	}, 500)
            },
            editUser(user) {
            	this.editmode = true

            	this.form.fill(user)
            },
            generatePassword() {
            	this.form.password = Math.random().toString(36).slice(-8).toUpperCase()

            	this.generatedPassword = true

            	$('#password').attr('type', 'text')
            	
            	setTimeout(() => {
            		$('#password').select()

            		document.execCommand("copy");
            	}, 100)

            	Toast.fire({
            		type: 'success',
            		title: 'Password is now copied to clipboard'
            	})
            },
            updateUser() {
            	const loader = this.$loading.show()

            	this.form.put('/api/user/'+this.form.id)
            	.then(() => {
            		this.loadUsers()
            		this.editmode = false
            		Swal.fire({
            			type: 'success',
            			title: 'Successful',
            			text: 'User was updated successfully'
            		})

            		loader.hide()
            	})
            	.catch(() => {
            		Swal.fire({
            			type: 'error',
            			title: 'Something went wrong',
            			text: 'User could not be updated'
            		})

            		loader.hide()
            	})
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