<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					<span v-if="editmode == true">Edit</span> 
					<span v-else>Add New</span>
					Request
				</h4>
				<p class="category">Let freelancers contact you for a solution</p>
			</div>
			<div class="content">
				<alert-error :form="form"></alert-error>
				
				<form method="POST" @submit.prevent="editmode ? updateRequest() : submitRequest()" @keydown="form.onKeydown($event)">
					<div class="row">
						<div class="col-md-6">
							<label for="category">Category</label>
							<select class="form-control" v-model="form.service.category.id" @change="loadCategoryServices" id="category" :class="{ 'has-error':form.errors.has('service.category.id') }" required>
								<option disabled value="">Choose a category</option>
								<option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="service">Sub-category</label>
							<select class="form-control" v-model="form.service.id" id="service" :class="{ 'has-error':form.errors.has('service.id') }" required>
								<option disabled value="">Choose a sub-category</option>
								<option v-for="service in categoryServices" :key="service.id" :value="service.id">{{ service.name }}</option>
							</select>
							<has-error :form="form" field="service.id"></has-error>
						</div>
					</div>
					<div class="row">
                        <div class="col-12">
                        	<label for="title">Title</label>
                            <input type="text" class="form-control" :class="{ 'has-error':form.errors.has('title') }" v-model="form.title" id="title" placeholder="Title your project (Min: 10)" minlength="10" required>
                            <span class="help-block text-primary">Say what you need in 10 characters or more</span>
                            <has-error :form="form" field="title"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        	<label for="description">Description</label>
                            <textarea rows="10" class="form-control" :class="{ 'has-error':form.errors.has('description') }" v-model="form.description" id="description" placeholder="Describe your project in the simplest language... (Min: 50)" minlength="50" required></textarea>
                            <span class="help-block text-primary">Please describe with up to 50 characters long, so your to-be assistant is clear on the details</span>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-12">
                        	<label for="price">Budget</label>
                        	<div class="input-group">
                           		<div class="input-group-addon" id="addon-price">₦</div>
                            	<input type="number" name="price" v-model="form.price" min="1000.00" id="price" placeholder="5000.00" class="form-control" :class="{ 'has-error':form.errors.has('price') }" aria-describedby="addon-price" required>
                            </div>
                        	<has-error :form="form" field="price"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        	<label for="address">Address</label>
                            <input type="text" class="form-control" :class="{ 'has-error':form.errors.has('address') }" v-model="form.address" id="address" placeholder="Descriptive address you intend to find help for this request" required>
                            <has-error :form="form" field="address"></has-error>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit" v-show="!editmode">Submit Request</button>
                    <button class="btn btn-success btn-fill" :disabled="form.busy" type="submit" v-show="editmode">Update Request</button>
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
					service: {
						id: '',
						category: {
							id: ''
						}
					},
					service_id: '',
					title: '',
					description: '',
					price: '',
					address: ''
				}),

				categories: {},
				categoryServices: {},

				url: '/api/request',
				categoryURL: '/api/category/',
				categoryServicesURL: '/api/category/services/',
			}
		},
		methods: {
			loadRequest(id) {
				const loader = this.$loading.show()

				axios.get(this.url+'/'+id)
				.then((response) => {
					this.form.fill(response.data)
					this.loadCategoryServices()

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
						title: 'Something went wrong loading the sub categories'
					})

					loader.hide()
				})
			},
			submitRequest() {
				const loader = this.$loading.show()

				this.form.service_id = this.form.service.id

				this.form.post(this.url)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Request was submitted successfully',
						html: 'One of our freelancers should contact you on the request soon<br>We can only try to log the request to freelancers, we cannot obligate any of them to accept your proposal'
					})

					this.form.reset()

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'Something went wrong. Please check your inputs'
					})

					loader.hide()
				})
			},
			updateRequest() {
				const loader = this.$loading.show();

				this.form.put(this.url+'/'+this.form.id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Request was updated successfully'
					})

					this.form.reset();
					
					window.location.href = '/user/requests'
				})
				.catch(() => {
					Swal.fire({
						title: 'Oops!',
						text: 'Request was not updated for some reason',
						type: 'error'
					});

					loader.hide();
				})
			},
		},
		created() {
			this.loadCategories()

			this.requestToLoad = this.$route.params.id
			if (this.requestToLoad) {
				this.editmode = true

				this.loadRequest(this.requestToLoad)
			} else {
				this.form.reset()
			}
		},
		mounted() {

		}
	}
</script>