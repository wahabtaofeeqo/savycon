<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					<!-- Adverts <span class="badge badge-primary">{{ pagination.total_items }}</span> -->
					<p>Advertise</p>
					<button class="pull-right btn btn-primary btn-fill" @click="openModal" v-show="!createmode">Add New</button>
					<button class="pull-right btn btn-default btn-fill" @click="openModal" v-show="!createmode">Close Form</button>
					<div class="clearfix"></div>
				</h4>

				<p class="category" v-show="!createmode">All adverts</p>

				<alert-error :form="form"></alert-error>

				<form method="POST" v-show="createmode" id="form" @submit.prevent="createAdvert()" @keydown="form.onKeydown($event)" class="form">
					<hr>
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" v-model="form.title" class="form-control" :class="{ 'has-error':form.errors.has('title') }" placeholder="Title" autofocus="on" id="title" required>
						<has-error :form="form" field="title"></has-error>
					</div>
					<div class="form-group">
						<label for="description">Describe the Ad</label>
						<input type="text" name="description" v-model="form.description" class="form-control" :class="{ 'has-error':form.errors.has('description') }" id="description" placeholder="Describe the Ad" required>
						<has-error :form="form" field="description"></has-error>
					</div>
					<div class="form-group">
						<label for="link">Web URL</label>
						<input type="url" name="URL" v-model="form.URL" class="form-control" :class="{ 'has-error':form.errors.has('URL') }" placeholder="Link to the Ad" id="link" required>
						<has-error :form="form" field="URL"></has-error>
					</div>
					<div class="form-group">
						<label for="image">Featured Image</label>
						<input type="file" name="image" accept="image/*" @change="updateImage" class="form-control" :class="{ 'has-error':form.errors.has('image') }" id="image" required>
						<has-error :form="form" field="image"></has-error>
					</div>
					<div class="form-group">
						<label for="layer">Section to display AD</label>
						<select class="form-control" v-model="form.layer" id="layer" required>
							<option disabled value="">Select a section to display the Ad</option>
							<option value="all">All Platforms</option>
							<option value="home">Homepage</option>
							<option value="dashboard">Dashboards</option>
						</select>
						<has-error :form="form" field="layer"></has-error>
					</div>
					<div class="form-group">
						<label for="layer">Adverts Package</label>
						<select class="form-control" v-model="form.package" id="layer" required>
							<option disabled value="">Select Ads Package</option>
							<option value="month">Month</option>
							<option value="week">Week</option>
						</select>
						<has-error :form="form" field="layer"></has-error>
					</div>
					<div class="form-group">
						<label for="states">
							Choose the states to include this
							<small class="help-block text-primary">Do not check any box if you want the Ad to show in all states</small>
						</label>
						<div class="row">
							<div class="col-md-2" v-for="state in states">
								<div class="form-check">
		                            <label class="form-check-label">
										<input type="checkbox" name="states" :id="state.name" v-model="form.states" class="form-check-input" :class="{ 'has-error':form.errors.has('states') }" :value="state.id">
										{{ state.name }}
									</label>
								</div>
							</div>
						</div>
						<has-error :form="form" field="states"></has-error>
					</div>

					<button type="submit" :disabled="form.busy" class="btn btn-fill btn-primary">Create AD</button>
					<hr>
				</form>
			</div>

			<div class="content" v-show="!createmode">
				<div class="alert alert-danger" v-show="adverts.length < 1">
					There are no adverts yet
				</div>
				<div class="table-responsive table-full-width" v-show="adverts.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Title</th>
								<th>Description</th>
								<th>Showing</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="advert in adverts">
								<td>
									<a :href="advert.URL" class="btn btn-sm btn-fill btn-primary" target="__blank">Open</a>
								</td>
								<td>{{ advert.title }}</td>
								<td>{{ advert.description }}</td>
								<td>{{ advert.layer.toUpperCase() }}</td>
								<td>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteAdvert(advert.id)">Delete</button>
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
					:click-handler="fetchPaginateAdvertsWithIndex"
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
				createmode: true,

				states: [],
				adverts: [],
				pagination: {},

				form: new Form({
					id: '',
					title: '',
					description: '',
					package: '',
					URL: '',
					states: [],
					image: '',
					layer: '',
				}),

				url: '/api/advert/',
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
			loadAdverts() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.adverts = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load your adverts at the moment'
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
            fetchPaginateAdvertsWithIndex(pageno) {
                this.url = '/api/advert?page='+pageno;
                this.loadAdverts();
            },
			createAdvert() {
				const loader = this.$loading.show()

				this.form.post(this.url)
				.then((response) => {
					// Swal.fire({
					// 	type: 'success',
					// 	title: 'Advert was successfully created',
					// })

					//this.createmode = false
					this.form.reset()

					//Fire.$emit('refreshAdverts')

					loader.hide();

					this.makePayment(response.data.id);

				})
				.catch((err) => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					console.log(err);

					loader.hide()
				})
			},

			makePayment(id) {
			    FlutterwaveCheckout({
			      	public_key: "FLWPUBK_TEST-fec63da3bb65c48db6b9f1421164a2c1-X", 
			      	tx_ref: "hooli-tx-1920bbtyt",
			      	amount: 20,
			      	currency: "NGN",
			      	country: "NG",
			      	payment_options: "card, mobilemoneyghana, ussd",
			      	customer: {
			        	email: "tao@yahoo.com",
			        	phone_number: "2340812345643",
			        	name: "Advertisement",
			      	},
			      	callback: function (data) {

			        	if (data.status == "successful") {
			        		axios.get('/api/activate-advert/' + id)
				      		.then(response => {
				      			
				      		})
				      		.catch(err => {
				      			
				      		})
			        	}
			      	},
			      	onclose: function() {
			        	console.log("Closed");
			      	},
			      	customizations: {
			        	title: "Advertisement Fee",
			        	description: "Payment for prodcuts been advertised.",
			      	},
			    });
			},

			deleteAdvert(id) {
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

						axios.delete('/api/advert/'+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'Advert was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshAdverts')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the advert.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			openModal() {
				if (this.createmode) {
					this.createmode = false
				} else {
					this.createmode = true
				}

				this.form.reset()
			},
			updateImage(e) {
                let file = e.target.files[0];
                var reader = new FileReader();

                if (file['size'] < 2097152 && (file['type'] == 'image/jpeg' || file['type'] == 'image/png' || file['type'] == 'image/jpg')) {
                    reader.onloadend = (file) => {
                        this.form.image = reader.result;
                    }

                    reader.readAsDataURL(file);
                } else {
                    Swal.fire(
                        'Oops...',
                        'Please check the format (JPEG, JPG, PNG) and size (< 2MB) of the image.',
                        'error'
                    )
                }
            },
		},
		created() {
			this.loadStates()
			//this.loadAdverts()

			Fire.$on('refreshAdverts', () => {
				this.loadStates()
			})
		},
		mounted() {

		}
	}
</script>