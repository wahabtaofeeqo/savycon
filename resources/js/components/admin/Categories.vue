<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					Categories <span class="badge badge-primary">{{ categories.length }}</span>
					<button class="pull-right btn btn-primary btn-fill" @click="openModal" v-show="!createmode">Add New</button>
					<button class="pull-right btn btn-default btn-fill" @click="openModal" v-show="createmode">Close Form</button>
					<div class="clearfix"></div>
				</h4>
				<p class="category">All categories</p>

				<alert-error :form="form"></alert-error>
				<alert-error :form="serviceForm"></alert-error>

				<form method="POST" v-show="createmode" id="form" @submit.prevent="editmode ? updateCategory() : createCategory()" @keydown="form.onKeydown($event)">
					<hr>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="name" v-model="form.name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" placeholder="Name" autofocus="on" required>
							<div class="input-group-btn">
								<button type="submit" :disabled="form.busy" class="btn btn-primary btn-fill" v-show="!editmode">Create</button>
								<button type="submit" :disabled="form.busy" class="btn btn-success btn-fill" v-show="editmode">Update</button>
							</div>
						</div>
						<has-error :form="form" field="name"></has-error>
					</div>
					<hr>
				</form>

				<form method="POST" v-show="serviceCreateMode" id="serviceForm" @submit.prevent="serviceEditMode ? updateService() : createService()" @keydown="serviceForm.onKeydown($event)">
					<hr>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="name" v-model="serviceForm.name" class="form-control" :class="{ 'has-error':serviceForm.errors.has('name') }" placeholder="Name" autofocus="on" required>
							<div class="input-group-addon">-</div>
							<select class="form-control" name="category_id" v-model="serviceForm.category.id" required>
								<option disabled value="">Select a category</option>
								<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
							</select>
							<div class="input-group-btn">
								<button type="submit" :disabled="serviceForm.busy" class="btn btn-primary btn-fill" v-show="!serviceEditMode">Create</button>
								<button type="submit" :disabled="serviceForm.busy" class="btn btn-success btn-fill" v-show="serviceEditMode">Update</button>
							</div>
						</div>
						<has-error :form="serviceForm" field="name"></has-error>
					</div>
					<hr>
				</form>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-lg-12" id="showbox">
						<div class="alert alert-danger" v-show="categories.length < 1">
							There are no categories yet
						</div>
						<div class="table-responsive table-full-width" v-show="categories.length > 0">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="category in categories">
										<td>{{ category.name }}</td>
										<td>
											<button class="btn btn-sm btn-success btn-fill" @click="showServices(category)">Show Sub-categories</button>
											<button class="btn btn-sm btn-primary btn-fill" @click="editCategory(category)">Edit</button>
											<button class="btn btn-sm btn-danger btn-fill" @click="deleteCategory(category.id)">Delete</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Pagination -->
						<div class="paginator">
							<button class="btn btn-fill btn-primary" @click="fetchPaginateCategories(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" v-show="pagination.prev_page_url">
								<i class="fa fa-arrow-left"></i> Prev
							</button>

							<button class="btn btn-fill btn-primary pull-right" @click="fetchPaginateCategories(pagination.next_page_url)" :disabled="!pagination.next_page_url" v-show="pagination.next_page_url">
								Next <i class="fa fa-arrow-right"></i>
							</button>

							<div class="clearfix"></div>
						</div>
					</div>

					<!-- Sub categories -->
					<div class="col-lg-6" v-show="serviceMode" ref="serviceContainer">
						<alert-error :form="serviceForm"></alert-error>
						<div style="border-bottom: 1px solid;">
							<h4>
								{{ selectedCategory }} <span class="badge badge-primary">{{ services.length }}</span>
								<button class="pull-right btn btn-sm btn-fill btn-primary" @click="openServiceModal" v-show="!serviceCreateMode">Add New Sub-Category</button>
								<button class="pull-right btn btn-sm btn-fill btn-default" @click="openServiceModal" v-show="serviceCreateMode">Close Form</button>
								<div class="clearfix"></div>
							</h4>
						</div>

						<div class="alert alert-info" v-if="services.length < 1">
							There are no sub categories in this category yet!
						</div>
						<div class="table-responsive table-full-width" v-else>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Name</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(service, index) in services">
										<td>{{ index+1 }}</td>
										<td>{{ service.name }}</td>
										<td>
											<button class="btn btn-sm btn-primary btn-fill" @click="editService(service)">Edit</button>
											<button class="btn btn-sm btn-danger btn-fill" @click="deleteService(service.id)">Delete</button>
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
				createmode: false,
				editmode: false,

				selectedCategory: '',
				serviceMode: false,
				serviceCreateMode: false,
				serviceEditMode: false,

				categories: [],
				pagination: {},
				services: [],

				form: new Form({
					id: '',
					name: '',
				}),

				serviceForm: new Form({
					id: '',
					name: '',
					category: {
						id: ''
					}
				}),

				categoryURL: '/api/categories/',
				serviceURL: '/api/sub-categories/',
			}
		},
		methods: {
			loadCategories() {
				const loader = this.$loading.show()

				axios.get(this.categoryURL)
				.then((response) => {
					this.categories = response.data.data

					this.makePagination(response.data)

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'We could not retrieve the categories'
					})

					loader.hide()
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
            fetchPaginateCategories(url) {
                this.categoryURL = url;
                this.loadCategories();
            },
			deleteCategory(id) {
				$('#showbox')
					.addClass('col-lg-12')
					.removeClass('col-lg-6')
					.css('border', '0')

				this.serviceMode = false
				this.serviceCreateMode = false

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

						axios.delete('/api/categories/'+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'Category was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshCategories')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the category.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			editCategory(category) {
				$('#showbox')
					.addClass('col-lg-12')
					.removeClass('col-lg-6')
					.css('border', '0')

				this.serviceMode = false
				this.serviceCreateMode = false

				this.createmode = true
				this.editmode = true
				this.form.fill(category)
			},
			openModal() {
				if (this.createmode) {
					this.createmode = false
				} else {
					this.createmode = true
				}

				this.editmode = false
				this.form.reset()
			},
			createCategory() {
				const loader = this.$loading.show()

				this.form.post('/api/categories')
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Category was successfully created',
					})

					this.createmode = false
					Fire.$emit('refreshCategories')

					this.form.reset()

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					loader.hide()
				})
			},
			updateCategory() {
				const loader = this.$loading.show()

				this.form.put('/api/categories/'+this.form.id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Category was successfully updated',
					})

					this.createmode = false
					this.form.reset()

					Fire.$emit('refreshCategories')

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					loader.hide()
				})
			},
			showServices(category) {
				$('#showbox')
					.removeClass('col-lg-12')
					.addClass('col-lg-6')
					.css('border-right', '1px solid')
				this.createmode = false

				this.serviceMode = true
				this.selectedCategory = category.name

				this.serviceForm.reset()
				this.serviceCreateMode = false
				this.serviceEditMode = false

				this.serviceForm.category.id = category.id
				this.loadServices(category.id)
			},
			loadServices(id) {
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				axios.get('/api/sub-categories/'+id)
				.then((response) => {
					this.services = response.data

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			openServiceModal() {
				if (this.serviceCreateMode) {
					this.serviceCreateMode = false
				} else {
					this.serviceCreateMode = true
				}

				this.serviceEditMode = false
				this.serviceForm.reset()
			},
			createService() {
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				this.serviceForm.post('/api/sub-categories')
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Sub-Category was successfully created',
					})

					this.serviceCreateMode = false
					Fire.$emit('refreshSubCategories')

					this.serviceForm.reset()
					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					loader.hide()
				})
			},
			editService(service) {
				this.serviceCreateMode = true
				this.serviceEditMode = true
				this.serviceForm.fill(service)
			},
			updateService() {
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				this.serviceForm.put('/api/sub-categories/'+this.serviceForm.id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Sub-Category was successfully updated',
					})

					this.serviceCreateMode = false
					Fire.$emit('refreshSubCategories')

					this.serviceForm.reset()

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					loader.hide()
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
						const loader = this.$loading.show({
							container: this.$refs.serviceContainer,
						});

						axios.delete('/api/sub-categories/'+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'Sub-Category was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshSubCategories')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the Sub-Category.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
		},
		created() {
			this.loadCategories()

			Fire.$on('refreshCategories', () => {
				this.loadCategories()
			})
			Fire.$on('refreshSubCategories', () => {
				this.loadServices(this.serviceForm.category.id)
			})
		},
		mounted() {

		}
	}
</script>