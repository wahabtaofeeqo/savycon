<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					<span v-if="editmode == true">Edit</span> 
					<span v-else>Add New</span> 
					Service
				</h4>
				<p class="category">Let your customers find you</p>
			</div>
			<div class="content">
				<alert-error :form="form"></alert-error>
				
				<form method="POST" @submit.prevent="editmode ? updateService() : createService()" @keydown="form.onKeydown($event)">
					<div class="row">
						<div class="col-md-7">
	                        <div class="form-group">
		                    	<div class="row">
			                        <div class="col-md-6">
			                        	<label for="category">Category</label>
			                            <select class="form-control" id="category" @change="loadCategoryServices()" v-model="form.service.category.id" required>
			                            	<option disabled value="">Choose a category</option>
			                            	<option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{ category.name }}</option>
			                        	</select>
			                        </div>
			                        <div class="col-md-6">
			                        	<label for="service">Sub-Category</label>
			                            <select class="form-control" id="service" v-model="form.service.id" required>
			                            	<option disabled value="">Choose a sub-category</option>
			                            	<option v-for="service in categoryServices" :key="service.id" v-bind:value="service.id">{{ service.name }}</option>
			                        	</select>
			                        	<has-error :form="form" field="service.id"></has-error>
			                        </div>
			                    </div>
		                    </div>
		                    <div class="form-group">
	                        	<label for="title">Title</label>
	                            <input v-model="form.title" type="text" name="title" placeholder="Title" class="form-control" :class="{ 'has-error':form.errors.has('title') }" id="title" required>
	                            <has-error :form="form" field="title"></has-error>
	                        </div>
		                    <div class="form-group">
	                        	<label for="description">Description</label>
	                            <textarea class="form-control w-100" rows="5" v-model="form.description" name="description" placeholder="Describe your service" :class="{ 'has-error':form.errors.has('description') }" id="description" required></textarea>
	                            <has-error :form="form" field="description"></has-error>
		                    </div>
		                    <div class="form-group">
		                    	<div class="row">
			                        <div class="col-md-6">
			                        	<label for="state">State</label>
			                            <select class="form-control" id="state" @change="loadStateCities()" v-model="form.city.state.id" required>
			                            	<option disabled value="">Choose a state</option>
			                            	<option v-for="state in states" :key="state.id" v-bind:value="state.id">{{ state.name }}</option>
			                        	</select>
			                        </div>
			                        <div class="col-md-6">
			                        	<label for="city">City</label>
			                            <select class="form-control" id="city" v-model="form.city.id" required>
			                            	<option disabled value="">Choose a city</option>
			                            	<option v-for="city in cities" :key="city.id" v-bind:value="city.id">{{ city.name }}</option>
			                        	</select>
			                        	<has-error :form="form" field="city.id"></has-error>
			                        </div>
			                    </div>
		                    </div>
		                    <div class="form-group">
		                    	<label for="address">Full address of where you offer this service</label>
	                            <input type="text" name="address" v-model="form.address" id="address" placeholder="Descriptive address where you intend to offer this service" class="form-control" :class="{ 'has-error':form.errors.has('address') }" required>
	                            <has-error :form="form" field="address"></has-error>
		                    </div>
		                    <div class="form-group">
		                    	<label for="price">Starting Price</label>
	                        	<div class="input-group">
	                            	<div class="input-group-addon">₦</div>
	                            	<input type="number" name="price" v-model="form.price" min="500.00" id="price" placeholder="5000.00" class="form-control" :class="{ 'has-error':form.errors.has('price') }" aria-describedby="addon-price" required>
	                            </div>
	                            <has-error :form="form" field="price"></has-error>
		                    </div>
		                </div>
		                <div class="col-md-5">
		                	<div class="form-group text-warning">
			                	<strong>We strongly recommend you upload images of your services that meet the following requirements:</strong>
			                	<ul>
			                		<li>Must be a JPG or PNG file</li>
			                		<li>Must be less than 2MB in size</li>
			                	</ul>
			                </div>
			                <div class="row">
			                	<div class="col-md-4 col-sm-4">
				                	<div class="form-group">
					                	<label for="image_1">Image 1</label>
					                	<div class="dropzone">
					                		<input type="file" name="image_1" class="form-control dropzone-file" id="image_1" accept="image/*" @change="updateImage1">
					                		<img src="" alt="Drag or Click to Upload" id="dropzone-image1" class="dropzone-image">
					                	</div>
					                	
					                	<small class="help-block text-info" v-show="!editmode"><i class="fa fa-info-circle"></i> Required</small>
					                	<small class="help-block text-info" v-show="editmode"><i class="fa fa-info-circle"></i> Ignore if you do not wish to change</small>
					                	<has-error :form="form" field="image_1"></has-error>
					                </div>
					            </div>
					            <div class="col-md-4 col-sm-4">
				                	<div class="form-group">
					                	<label for="image_2">Image 2</label>
					                	<div class="dropzone">
					                		<input type="file" name="image_2" class="form-control dropzone-file" id="image_2" accept="image/*" @change="updateImage2">
					                		<img src="" alt="Drag or Click to Upload" id="dropzone-image2" class="dropzone-image">
					                	</div>
					                	
					                	<small class="help-block text-info" v-show="!editmode"><i class="fa fa-info-circle"></i> Required</small>
					                	<small class="help-block text-info" v-show="editmode"><i class="fa fa-info-circle"></i> Ignore if you do not wish to change</small>
					                	<has-error :form="form" field="image_2"></has-error>
					                </div>
					            </div>
					            <div class="col-md-4 col-sm-4">
				                	<div class="form-group">
					                	<label for="image_3">Image 3</label>
					                	<div class="dropzone">
					                		<input type="file" name="image_3" class="form-control dropzone-file" id="image_3" accept="image/*" @change="updateImage3">
					                		<img src="" alt="Drag or Click to Upload" id="dropzone-image3" class="dropzone-image">
					                	</div>
					                	
					                	<small class="help-block text-info" v-show="!editmode"><i class="fa fa-info-circle"></i> Required</small>
					                	<small class="help-block text-info" v-show="editmode"><i class="fa fa-info-circle"></i> Ignore if you do not wish to change</small>
					                	<has-error :form="form" field="image_3"></has-error>
					                </div>
					            </div>
					        </div>
		                </div>
		            </div>

                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit" v-show="!editmode">Create Service</button>
                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit" v-show="editmode">Update Service</button>
                    <router-link :to="{ name: 'AdminServices' }" class="btn btn-danger btn-fill" type="button" v-show="editmode">Cancel</router-link>

                    <div class="clearfix"></div>
		        </form>
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
					price: '',
					image_1: '',
					image_2: '',
					image_3: '',
					address: '',
					service: {
						id: '',
						category: {
							id: '',
						},
					},
					city: {
						id: '',
						state: {
							id: ''
						}
					}
				}),

				categories: {},
				categoryServices: {},

				states: {},
				cities: {},

				serviceToLoad: '',

				url: '/api/service',

				categoryURL: '/api/category',
				categoryServicesURL: '/api/category/services/',

				statesURL: '/api/states',
				stateCitiesURL: '/api/states/cities/',
			}
		},
		methods: {
			loadService(id) {
				const loader = this.$loading.show()

				axios.get(this.url+'/'+id)
				.then((response) => {
					this.form.fill(response.data)
					this.loadCategoryServices()
					this.loadStateCities()

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not find the service you are looking for'
					})

					loader.hide()
				})
			},
			loadCategories() {
				axios.get(this.categoryURL)
				.then(response => {
					this.categories = response.data
				});
			},
			loadCategoryServices() {
				const loader = this.$loading.show()

				axios.get(this.categoryServicesURL+this.form.service.category.id)
				.then((response) => {
					this.categoryServices = response.data
					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not gather the sub-categories at the moment'
					})
					loader.hide()
				})
			},
			loadStates() {
				axios.get(this.statesURL)
				.then(response => {
					this.states = response.data
				});
			},
			loadStateCities() {
				const loader = this.$loading.show()

				axios.get(this.stateCitiesURL+this.form.city.state.id)
				.then((response) => {
					this.cities = response.data
					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not gather the cities at the moment'
					})
					loader.hide()
				})
			},
            updateImage1(e) {
                let file = e.target.files[0];
                var reader = new FileReader();

                if (file['size'] < 2097152 && (file['type'] == 'image/jpeg' || file['type'] == 'image/png' || file['type'] == 'image/jpg')) {
                    reader.onloadend = (file) => {
                        this.form.image_1 = reader.result;

                        $('#dropzone-image1').attr('src', reader.result)
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
            updateImage2(e) {
                let file = e.target.files[0];
                var reader = new FileReader();

                if (file['size'] < 2097152 && (file['type'] == 'image/jpeg' || file['type'] == 'image/png' || file['type'] == 'image/jpg')) {
                    reader.onloadend = (file) => {
                        this.form.image_2 = reader.result;

                        $('#dropzone-image2').attr('src', reader.result)
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
            updateImage3(e) {
                let file = e.target.files[0];
                var reader = new FileReader();

                if (file['size'] < 2097152 && (file['type'] == 'image/jpeg' || file['type'] == 'image/png' || file['type'] == 'image/jpg')) {
                    reader.onloadend = (file) => {
                        this.form.image_3 = reader.result;

                        $('#dropzone-image3').attr('src', reader.result)
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
			createService() {
				const loader = this.$loading.show();

				this.form.post(this.url)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Service was added successfully',
						text: 'We will reload the page now...'
					})

					this.form.reset();

					setTimeout(() => {
						window.location.reload()
					}, 3000)
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
			updateService() {
				const loader = this.$loading.show();

				this.form.put(this.url+'/'+this.form.id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Service was updated successfully'
					})

					this.form.reset();
					
					window.location.href = '/vendor/services'
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
		},
		created() {
			this.loadCategories();
			this.loadStates();

			this.serviceToLoad = this.$route.params.id
			if (this.serviceToLoad) {
				this.editmode = true

				this.loadService(this.serviceToLoad)
			} else {
				this.form.reset()
			}
		},
		mounted() {

		}
	}
</script>

<style scoped>
	.dropzone {
		height: 150px;
		width: 150px;
		background: lightgray;
		border-radius: 10px;
	}
	.dropzone-file {
		opacity: 0;
		position: absolute;
		height: 150px;
		width: 150px;
	}
	.dropzone-image {
		height: 150px;
		width: 150px;
		background: lightgray;
		border-radius: 10px;
	}
</style>
