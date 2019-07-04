<template>
	<div>
		<div class="row">
			<div class="col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="card-title">Add New Service</h4>
						<p class="category">Let your customers find you</p>
					</div>
					<div class="content">
						<form method="POST" @submit.prevent="editmode ? updateService() : createService()" @keydown="form.onKeydown($event)">
							<div class="row">
		                        <div class="col-12">
		                        	<label for="title">Title</label>
		                            <input v-model="form.title" type="text" name="title" placeholder="Title" class="form-control" :class="{ 'has-error':form.errors.has('title') }" id="title" required>
		                            <has-error :form="form" field="title"></has-error>
		                        </div>
		                    </div>
	                        <div class="row">
		                        <div class="col-12">
		                        	<label for="description">Description</label>
		                            <textarea class="form-control w-100" rows="5" v-model="form.description" name="description" placeholder="Describe your service" :class="{ 'has-error':form.errors.has('description') }" id="description" required></textarea>
		                            <has-error :form="form" field="description"></has-error>
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-12">
		                        	<div class="input-group">
		                            	<div class="input-group-prepend">
		                            		<div class="input-group-text" id="addon-price">₦</div>
		                            	</div>
		                            	<input type="number" name="price" v-model="form.price" min="1000.00" id="price" placeholder="5000.00" class="form-control" :class="{ 'has-error':form.errors.has('price') }" aria-describedby="addon-price" required>
		                            </div>
		                            <has-error :form="form" field="price"></has-error>
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-md-6">
		                        	<label for="category">Category</label>
		                            <select class="form-control" id="category" @change="loadCategoryServices()" v-model="form.service.category.id" required>
		                            	<option disabled value="">Choose a category</option>
		                            	<option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{ category.name }}</option>
		                        	</select>
		                        </div>
		                        <div class="col-md-6">
		                        	<label for="category">Sub-Category</label>
		                            <select class="form-control" id="service" v-model="form.service.id" required>
		                            	<option disabled value="">Choose a sub-category</option>
		                            	<option v-for="service in categoryServices" :key="service.id" v-bind:value="service.id">{{ service.name }}</option>
		                        	</select>
		                        	<has-error :form="form" field="service.id"></has-error>
		                        </div>
		                    </div>

		                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit" v-show="!editmode">Create Service</button>
		                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit" v-show="editmode">Update Service</button>
		                    <div class="clearfix"></div>
				        </form>
					</div>
				</div>
			</div>
			<div class="col-md-5">
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
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="service in services">
										<td>
											<a :href="viewService(id)" class="btn btn-sm btn-success">View</a>
										</td>
										<td>{{ service.title }}</td>
										<td>
											<button class="btn btn-sm btn-info" @clcik="editService(service)">Edit</button>
											<button class="btn btn-sm btn-danger" @clcik="deleteService(service.id)">Delete</button>
										</td>
									</tr>
								</tbody>
							</table>
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
				editmode: false,

				form: new Form({
					id: '',
					title: '',
					description: '',
					image_1: '',
					image_2: '',
					image_3: '',
					service: {
						id: '',
						category: {
							id: '',
						},
					}
				}),

				services: {},
				categories: {},
				categoryServices: {},
				pagination: [],

				url: '/vendor/service',
			}
		},
		methods: {
			loadCategories() {
				axios.get('/category/')
				.then(response => {
					this.categories = response.data
				});
			},
			loadCategoryServices() {
				axios.get('/category/services/'+this.form.service.category.id)
				.then((response) => {
					this.categoryServices = response.data
				})
			},
			loadServices() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
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
                this.getServices();
            },
            viewFeaturedPhoto(file) {
            	return '/images/'+file;
            },
			createService() {
				const loader = this.$loader.show();

				this.form.post(this.url)
				.then(() => {
					Toast.fire({
						type: 'success',
						title: 'Service was added successfully'
					})

					this.form.reset();
					Fire.$emit('refreshServices');
				})
				.catch(() => {
					Swal.fire({
						title: 'Oops!',
						text: 'Service was not created for some reason',
						type: 'error'
					});

					loader.hide();
				})
			},
			editService(service) {
				this.form.fill(service);
			},
			updateService() {
				const loader = this.$loader.show();

				this.form.put(this.url)
				.then(() => {
					Toast.fire({
						type: 'success',
						title: 'Service was updated successfully'
					})

					this.form.reset();
					Fire.$emit('refreshServices');
				})
				.catch(() => {
					Swal.fire({
						title: 'Oops!',
						text: 'Service was not updated for some reason',
						type: 'error'
					});

					loader.hide();
				})
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
			this.loadCategories();
			this.loadServices();

			Fire.$on('refreshServices', () => {
				this.loadServices();
			})
		},
		mounted() {

		}
	}
</script>