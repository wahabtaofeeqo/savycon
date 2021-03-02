<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Subscribers <span class="badge badge-primary">{{ pagination.total_items }}</span></h4>
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
								<td>
									<button class="btn btn-sm btn-info btn-fill mx-3" @click="editUser(user)">Edit</button>
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
					:click-handler="fetchPaginateSubscribersWithIndex"
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
				subscribers: [],
				pagination: {},

				url: '/api/subscribers/',
			}
		},
		methods: {
			loadSubscribers() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.subscribers = response.data.data

					this.makePagination(response.data)

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
            fetchPaginateSubscribersWithIndex(pageno) {
                this.url = '/api/subscribers?page='+pageno;
                this.loadSubscribers();
            },
            deleteUser(id) {
            	Swal.fire({
            		icon: 'warning',
					title: 'Are you sure?',
					text: 'This action cannot be reverted',
					showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
				}).then(response => {
					const loader = this.$loading.show();
					if (response.isConfirmed) {
						axios.delete('/api/deleteSubscriber/' + id).then(response => {
							loader.hide();
							this.loadSubscribers();
						}).catch(err => {
							loader.hide();
						})
					}
				})
            },

            async editUser(user) {

            	const { value: email } = await Swal.fire({
            		icon: 'info',
					input: 'email',
					inputValue: user.email,
					showCancelButton: true,
					inputValidator: (value) => {
					    if (!value) {
					      return 'Email cannot be empty'
					    }
					}
				})

				if (email != user.email) {

					const loader = this.$loading.show();
					const data = {
						email: email,
						id: user.id
					};
				  	axios.post('/api/editSubscriber/', data).then(response => {
						loader.hide();
						this.loadSubscribers();
					}).catch(err => {
						loader.hide();
					})
				}
            }
		},
		created() {
			this.loadSubscribers();
		},
	}
</script>