<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Services</h4>
				<p class="category">All your services</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="services.length < 1">
					You have no services yet
				</div>
				<div class="table-responsive" v-show="services.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Title</th>
								<th>Description</th>
								<th>Price (₦)</th>
								<th>Category</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="service in services">
								<td>
									<a :href="viewService(service.id)" class="btn btn-sm btn-success btn-fill">View</a>
								</td>
								<td>{{ service.title }}</td>
								<td style="white-space: pre-line;">{{ service.description }}</td>
								<td>{{ service.price }}</td>
								<td>{{ service.service.category.name }} <br> > {{ service.service.name }}</td>
								<td>
									<router-link :to="{ name: 'VendorNewService', params: { id: service.id } }" class="btn btn-sm btn-info btn-fill">Edit</router-link>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteService(service.id)">Delete</button>
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
				services: {},
				pagination: [],

				url: '/vendor/service',
			}
		},
		methods: {
			loadServices() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load your services at the moment'
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
            fetchPaginateServices(url) {
                this.url = url;
                this.loadServices();
            },
			editService(service) {
				console.log('edit')
			},
			deleteService(id) {
				Swal.fire({
					title: 'Are you sure?',
					text: 'This action cannot be reverted',
					type: 'warning',
					showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
				})
				.then((result) => {
					if (result.value) {
						const loader = this.$loader.show();

						this.form.delete(this.url+'/'+id)
						.then(() => {
							Toast.fire({
								type: 'success',
								title: 'Service was deleted successfully'
							})

							Fire.$emit('refreshServices')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the service.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			viewService(id) {
            	return '/services/'+id;
            },
		},
		created() {
			this.loadServices();

			Fire.$on('refreshServices', () => {
				this.loadServices();
			})
		},
		mounted() {

		}
	}
</script>