<template>
	<div>
		<div class="card">

			<div style="padding: 10px">
				<button class="btn btn-danger" @click="changePassword">Change Password <i class="fa fa-lock"></i></button>
			</div>
			<div class="header">
				<h4 class="card-title" style="margin-top: 0;">Edit your Profile</h4>
				<p class="category">Change what is only required</p>
			</div>
			<div class="content">
				<alert-error :form="form"></alert-error>
				
				<form method="POST" @submit.prevent="updateProfile()" @keydown="form.onKeydown($event)">
					<div class="row">
                        <div class="col-md-12">
                        	<label for="name">Name</label>
                            <input v-model="form.name" type="text" name="name" placeholder="Name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" id="name" required>
                            <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        	<label for="email">Email address</label>
                            <input v-model="form.email" type="email" name="email" placeholder="Email address" class="form-control" :class="{ 'has-error':form.errors.has('email') }" id="email" required>
                            <has-error :form="form" field="email"></has-error>
                        </div>
                    </div>
                    <div class="row">
                  
                    	<div class="col-md-8">
                    		<label for="phone">Phone number</label>
	                        <div class="input-group">
	                           	<div class="input-group-addon" id="addon-phone">{{form.code}}</div>
	                            <input v-model="form.phone" type="tel" name="phone" placeholder="Phone number" class="form-control" :class="{ 'has-error':form.errors.has('phone') }" id="phone" aria-describedby="addon-phone" maxlength="10" required>
	                        </div>

	                        <span class="help-block text-info"><i class="fa fa-info-circle"></i> WhatsApp number preferably</span>
	                        <has-error :form="form" field="phone"></has-error>
                    	</div>

                    	<div class="col-md-4">
                    		<label for="code">Country Code</label>
                    		<input type="text" v-model="form.code" name="code" class="form-control" placeholder="+xxxxxx">
                    		<span class="help-block text-info">Optional (+234) by default</span>
                    	</div>
                    </div>

                    <div class="row">
                  
                    	<div class="col-md-8">
                    		<label for="phone">Second Phone number</label>
	                        <div class="input-group">
	                           	<div class="input-group-addon" id="addon-phone">{{form.code_second}}</div>
	                            <input v-model="form.second_phone" type="tel" name="second_phone" placeholder="Second Phone number" class="form-control" :class="{ 'has-error':form.errors.has('second_phone') }" id="second_phone" aria-describedby="addon-phone" maxlength="10">
	                        </div>

	                        <span class="help-block text-info d-none" style="display: none;"><i class="fa fa-info-circle"></i> WhatsApp number preferably</span>
	                        <!-- <has-error :form="form" field="phone"></has-error> -->
                    	</div>

                    	<div class="col-md-4">
                    		<label for="code">Country Code</label>
                    		<input type="text" v-model="form.code_second" name="code_second" class="form-control" placeholder="+xxxxxx">
                    		<span class="help-block text-info d-none" style="display: none;">Optional (+234) by default</span>
                    	</div>
                    </div>

                    <div class="row">
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
                    
                    <button class="btn btn-primary btn-fill" :disabled="form.busy" type="submit">Update Profile</button>
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
				states: {},
				cities: {},

				form: new Form({
					id: '',
					name: '',
					phone: '',
					email: '',
					code: '',
					second_phone: '',
					code_second: '',
					city: {
						id: '',
						state: {
							id: '',
						},
					},
					city_id: ''
				}),

				url: '/api/profile',
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
						type: 'warning',
						title: 'We could not load the states...'
					})
				})
			},
			loadCities() {
				const loader = this.$loading.show()

				axios.get('/api/states/cities/'+this.form.city.state.id)
				.then((response) => {
					this.cities = response.data

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'warning',
						title: 'We could not load the cities...'
					})

					loader.hide()
				})
			},
			loadUser() {
				const loader = this.$loading.show()

				axios.get(this.url)
				.then((response) => {
					console.log(response);
					this.form.fill(response.data)

					this.loadCities()

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			updateProfile() {
				const loader = this.$loading.show()

				this.form.city_id = this.form.city.id

				this.form.put(this.url+'/'+this.form.id)
				.then(() => {
					Swal.fire({
						icon: 'success',
						title: 'Profile was updated successfully',
					})

					Fire.$emit('refreshProfile')
					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},

			async changePassword() {
				const { value: password } = await Swal.fire({
	                title: 'New Password?',
	                input: 'password',
	                showCancelButton: true,
	                inputPlaceholder: 'Password...',
	                inputValidator: (value) => {
	                    if (!value || value.length < 8) {
	                        return "Password must be at least 8 characters";
	                    }
	                }
	            });

	            if (password != '' && password.length >= 8) {
	            	Swal.fire({
					  title: 'Do you want to save the changes?',
					  showCancelButton: true,
					  confirmButtonText: `Change`,
					})
					.then((result) => {
					  
					  	if (result.isConfirmed) {
					    	this.updatePassword(password);
					  	}
					})
	            }
			},

			updatePassword(password) {
				const loader = this.$loading.show();
				axios.post('/api/profile/password', {password: password})
				.then(response => {
					console.log(response);
					Swal.fire({
						icon: 'success',
					  	title: 'Password Update successfully',
					});
				})
				.catch(err => {
					console.log(err);
				})
				.finally(() => {
					loader.hide();
				})
			}
		},
		created() {
			this.loadStates()
			this.loadUser()

			Fire.$on('refreshProfile', () => {
				window.location.reload()
			})
		},
		mounted() {

		}
	}
</script>