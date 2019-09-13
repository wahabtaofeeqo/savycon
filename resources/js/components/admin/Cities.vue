<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					Cities <span class="badge badge-primary">{{ pagination.total_items }}</span>
					<button class="pull-right btn btn-primary btn-fill" @click="openModal" v-show="!createmode">Add New</button>
					<button class="pull-right btn btn-default btn-fill" @click="openModal" v-show="createmode">Close Form</button>
					<div class="clearfix"></div>
				</h4>
				<p class="category">All cities</p>

				<alert-error :form="form"></alert-error>

				<form method="POST" v-show="createmode" id="form" @submit.prevent="editmode ? updateCity() : createCity()" @keydown="form.onKeydown($event)">
					<hr>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="name" v-model="form.name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" placeholder="Name" autofocus="on" required>
							<div class="input-group-addon">-</div>
							<select class="form-control" name="state_id" v-model="form.state.id" required>
								<option disabled value="">Select a state</option>
								<option v-for="state in states" :value="state.id" :key="state.id">{{ state.name }}</option>
							</select>
							<div class="input-group-btn">
								<button type="submit" :disabled="form.busy" class="btn btn-primary btn-fill" v-show="!editmode">Create</button>
								<button type="submit" :disabled="form.busy" class="btn btn-success btn-fill" v-show="editmode">Update</button>
							</div>
						</div>
						<has-error :form="form" field="name"></has-error>
						<has-error :form="form" field="state.id"></has-error>
					</div>
					<hr>
				</form>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="cities.length < 1">
					There are no cities yet
				</div>
				<div class="table-responsive table-full-width" v-show="cities.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>State</th>
								<th>Number of Services</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="city in cities">
								<td>{{ city.name }}</td>
								<td>{{ city.state.name }}</td>
								<td>{{ city.user_services_count }}</td>
								<td>
									<button class="btn btn-sm btn-primary btn-fill" @click="editCity(city)">Edit</button>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteCity(city.id)">Delete</button>
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
					:click-handler="fetchPaginateCitiesWithIndex"
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
				createmode: false,
				editmode: false,

				states: [],
				cities: [],
				pagination: {},

				form: new Form({
					id: '',
					name: '',
					state: {
						id: '',
					}
				}),

				url: '/api/city/',
			}
		},
		methods: {
			loadStates() {
				axios.get('/api/states/')
				.then((response) => {
					this.states = response.data
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'We could not retrieve the states'
					})
				})
			},
			loadCities() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.cities = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load your cities at the moment'
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
            fetchPaginateCitiesWithIndex(pageno) {
                this.url = '/api/city?page='+pageno;
                this.loadCities();
            },
			deleteCity(id) {
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

						axios.delete('/api/city/'+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'City was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshCities')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the city.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			editCity(city) {
				this.createmode = true
				this.editmode = true
				this.form.fill(city)
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
			createCity() {
				const loader = this.$loading.show()

				this.form.post(this.url)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'City was successfully created',
					})

					this.createmode = false
					this.form.reset()

					Fire.$emit('refreshCities')

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
			updateCity() {
				const loader = this.$loading.show()

				this.form.put('/api/city/'+this.form.id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'City was successfully updated',
					})

					this.createmode = false
					this.form.reset()

					Fire.$emit('refreshCities')

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
		},
		created() {
			this.loadStates()
			this.loadCities()

			Fire.$on('refreshCities', () => {
				this.loadCities()
			})
		},
		mounted() {

		}
	}
</script>