<template>
	<div>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">Register</div>

		                <div class="card-body">
		                	<alert-error :form="form"></alert-error>

		                    <form method="POST" @submit.prevent="registerUser()" @keydown="form.onKeydown($event)">
		                    	<div class="form-group">
		                    		<label for="name">Name</label>
		                    		<input type="text" name="name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" v-model="form.name" placeholder="Full name" id="name" required>
		                    		<has-error :form="form" field="name"></has-error>
		                    	</div>
		                    	<div class="form-group">
		                    		<label for="email">E-mail address</label>
		                    		<input type="email" name="email" class="form-control" :class="{ 'has-error':form.errors.has('email') }" v-model="form.email" placeholder="E-mail address" id="email" required>
		                    		<has-error :form="form" field="email"></has-error>
		                    	</div>
		                    	<div class="form-group">
		                    		<label for="phone">Phone number</label>
		                    		<div class="input-group">
		                    			<div class="input-group-prepend">
		                    				<span class="input-group-text" id="addon-phone">+234</span>
		                    			</div>
		                    			<input type="text" name="phone" class="form-control" :class="{ 'has-error':form.errors.has('phone') }" v-model="form.phone" placeholder="Phone number" id="phone" aria-describedby="addon-phone" minlength="10" maxlength="10" required>
		                    		</div>

		                    		<span class="help-block text-info"><i class="fa fa-info-circle"></i> WhatsApp number preferably</span>
		                    		<has-error :form="form" field="phone"></has-error>
		                    	</div>
		                    	<div class="form-group row">
			                        <div class="col-md-6">
			                        	<label for="state">State</label>
			                            <select v-model="form.city.state.id" name="state_id" class="form-control" id="state" @change="loadCities()" required>
			                            	<option disabled value="">Select your state</option>
			                            	<option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
			                            </select>
			                            <has-error :form="form" field="city.state.id"></has-error>
			                        </div>
			                        <div class="col-md-6">
			                        	<label for="city">City</label>
			                            <select v-model="form.city.id" name="city" class="form-control" :class="{ 'has-error':form.errors.has('city.id') }" id="city" required>
			                            	<option disabled value="">Select your city</option>
			                            	<option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
			                            </select>
			                            <has-error :form="form" field="city.id"></has-error>
			                        </div>
			                    </div>
			                    <div class="form-group">
		                    		<label for="password">Password</label>
		                    		<input type="password" name="password" class="form-control" :class="{ 'has-error':form.errors.has('password') }" v-model="form.password" placeholder="Password" id="password" required>
		                    		<has-error :form="form" field="password"></has-error>
		                    	</div>
		                    	<div class="form-group">
		                    		<label for="password_confirmation">Confirm your password</label>
		                    		<input type="password" name="password_confirmation" class="form-control" :class="{ 'has-error':form.errors.has('password_confirmation') }" v-model="form.password_confirmation" placeholder="Re-enter your password" id="password_confirmation" required>
		                    		<has-error :form="form" field="password_confirmation"></has-error>
		                    	</div>

		                    	<button type="submit" :disabled="form.busy" class="btn btn-primary">Register</button>
		                    </form>
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
				form: new Form({
					id: '',
					name: '',
					email: '',
					phone: '',
					password: '',
					password_confirmation: '',
					role: 'user',
					city: {
						id: '',
						state: {
							id: ''
						}
					},
					city_id: '',
				}),

				states: {},
				cities: {},
				url: '/register',
			}
		},
		methods: {
			loadStates() {
				axios.get('/states/')
				.then((response) => {
					this.states = response.data
				})
				.catch(() => {
					Toast.fire({
						type: 'warning',
						title: 'We could not load the states...'
					})
				})
			},
			loadCities() {
				const loader = this.$loading.show()

				axios.get('/states/cities/'+this.form.city.state.id)
				.then((response) => {
					this.cities = response.data

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load the cities...'
					})

					loader.hide()
				})
			},
			registerUser() {
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success',
						cancelButton: 'btn btn-primary'
					},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: 'Register as?',
					html: 'Not sure? <a href="#" target="__blank">Click here</a> to understand what each user can do',
					type: 'info',
					showCancelButton: true,
					confirmButtonText: 'Vendor',
					cancelButtonText: 'Buyer',
					reverseButtons: true
				})
				.then((result) => {
					if (result.value) {
						this.form.role = 'vendor'
					}
					console.log(this.form.role)

					const loader = this.$loading.show()
					this.form.city_id = this.form.city.id

					this.form.post(this.url)
					.then(() => {
						Swal.fire({
							type: 'success',
							title: 'Yay!!!',
							text: 'You will be redirected now...'
						})

						setTimeout(() => {
							window.location.href = '/home'
						}, 2000)
					})
					.catch(() => {
						Swal.fire({
							title: 'Oops...',
							text: 'Something went horribly wrong!',
							type: 'error'
						})

						loader.hide()
					})
				})
			}
		},
		created() {
			this.loadStates()
		}
	}
</script>