<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Requests</h4>
				<p class="category">All your requests</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="requests.length < 1">
					You have no requests yet
				</div>

				<div v-show="requests.length > 0">
					<div class="row">
						<div class="col-md-6" v-for="(request, index) in requests">
							<div class="card">
								<div class="header">
									<h4 class="title">
										{{ index+1 }}
										<a :href="openRequest(request.id)" target="__blank" class="btn btn-sm btn-fill btn-success pull-right">View Service</a>
										<div class="clearfix"></div>
									</h4>
									<p class="category">{{ request.service.category.name }} > {{ request.service.name }}</p>
								</div>
								<div class="content">
									<div class="form-group">
										<label for="title">Title</label>
										<p id="title">{{ request.title }}</p>
									</div>
									<div class="form-group">
										<label for="description">Description</label>
										<p id="description">
											{{ request.description.substring(0, 200) }}
											<small v-show="request.description.length > 200">
												<a :href="openRequest(request.id)" target="__blank">read more...</a>
											</small>
										</p>
									</div>
									<div class="form-group">
										<label for="price">Budget</label>
										<p id="price">₦{{ request.price }}</p>
									</div>

									<router-link :to="{ name: 'PostRequest', params: { id: request.id } }" class="btn btn-sm btn-info btn-fill">Edit</router-link>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteRequest(request.id)">Delete</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				requests: [],
				pagination: {},

				url: '/api/request'
			}
		},
		methods: {
			loadRequests() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.requests = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load your requests at the moment'
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
            fetchPaginateRequests(url) {
                this.url = url;
                this.loadRequests();
            },
			deleteRequest(id) {
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
								title: 'Request was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshRequests')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the request.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			openRequest(id) {
				return '/buyers-requests/'+id;
			},
		},
		created() {
			this.loadRequests()

			Fire.$on('refreshRequests', () => {
				this.loadRequests();
			})
		},
		mounted() {

		}
	}
</script>