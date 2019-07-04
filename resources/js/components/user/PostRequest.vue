<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Make a request</h4>
				<p class="category">Let freelancers contact you for a solution</p>
			</div>
			<div class="content">
				<form method="POST" @submit.prevent="submitRequest()" @keydown="form.onKeydown($event)">
					<div class="row">
						<div class="col-md-6">
							<label for="category">Category</label>
							<select class="form-control" v-model="form.service.category.id" @change="loadServices" id="category" :class="{ 'has-error':form.errors.has('service.category.id') }" required>
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
						</div>
					</div>
					<div class="row">
                        <div class="col-12">
                        	<label for="title">Title</label>
                            <input type="text" class="form-control" :class="{ 'has-error':form.errors.has('title') }" v-model="form.title" id="title" placeholder="Title your project (Min: 20)" minlength="20" required>
                            <has-error :form="form" field="title"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        	<label for="description">Description</label>
                            <textarea rows="10" class="form-control" :class="{ 'has-error':form.errors.has('description') }" v-model="form.description" id="description" placeholder="Describe your project in the simplest language... (Min: 100)" minlength="100" required></textarea>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-12">
                        	<label for="price">Budget</label>
                        	<div class="input-group">
                            	<div class="input-group-prepend">
                            		<div class="input-group-text" id="addon-price">₦</div>
                            	</div>
                            	<input type="number" name="price" v-model="form.price" min="1000.00" id="price" placeholder="5000.00" class="form-control" :class="{ 'has-error':form.errors.has('price') }" aria-describedby="addon-price" required>
                            </div>
                        	<has-error :form="form" field="price"></has-error>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit">Submit Request</button>
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
				form: new Form({
					service: {
						id: '',
						category: {
							id: ''
						}
					},
					title: '',
					description: '',
					price: ''
				}),

				categories: {},
				categoryServices: {},

				url: '/user/post-request',
			}
		},
		methods: {
			loadCategories() {
				axios.get('/category/')
				.then(response => {
					this.categories = response.data
				});
			},
			loadServices() {
				const loader = this.$loading.show()

				axios.get('/category/services/'+this.form.service.category.id)
				.then((response) => {
					this.categoryServices = response.data

					loader.hide()
				})
				.catch(() => {
					Toast.fire({
						type: 'error',
						title: 'Something went wrong loading the sub categories'
					})

					loader.hide()
				})
			},
			submitRequest() {
				const loader = this.$loading.show()

				this.form.post(this.url)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Request was submitted successfully',
						html: 'One of our freelancers should contact you on the request soon<p><small>We can only try to log the request to freelancers, we cannot obligate any of them to accept your proposal</small></p>'
					})

					this.form.reset()

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
		},
		created() {
			this.loadCategories()
		},
		mounted() {

		}
	}
</script>