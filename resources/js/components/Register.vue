<template>
	<div>
    	<alert-error :form="form"></alert-error>
    	
        <form method="POST" @submit.prevent="registerUser()" @keydown="form.onKeydown($event)">
        	<div class="form-group m-b-20">
        		<div class="bor8 how-pos4-parent">
        			<input type="text" name="name" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('name') }" v-model="form.name" placeholder="Full name" id="name" autofocus="on" required>
        			<i class="how-pos4 pointer-none fa fa-user"></i>
        		</div>

        		<has-error :form="form" field="name"></has-error>
        	</div>

        	<div class="form-group m-b-20">
        		<div class="bor8 how-pos4-parent">
        			<input type="email" name="email" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('email') }" v-model="form.email" placeholder="E-mail address" id="email" required>
        			<i class="how-pos4 pointer-none fa fa-envelope"></i>
        		</div>

        		<has-error :form="form" field="email"></has-error>
        	</div>

        	<div class="form-group m-b-20">
        		<div class="bor8 how-pos4-parent">
        			<input type="tel" name="phone" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('phone') }" v-model="form.phone" placeholder="Phone number" id="phone" aria-describedby="addon-phone" minlength="10" maxlength="10" required>
        			<span class="how-pos4 pointer-none phone"></span>
        		</div>

        		<has-error :form="form" field="phone"></has-error>
        	</div>

        	<div class="form-group m-b-20 row">
                <div class="col-md-6">
                	<div class="bor8 how-pos4-parent">
                    	<select v-model="form.city.state.id" name="state_id" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" id="state" @change="loadCities()" required>
                        	<option disabled value="">Select your state</option>
                        	<option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
                        </select>
                        <i class="how-pos4 pointer-none fa fa-compass"></i>
                    </div>

                    <has-error :form="form" field="city.state.id"></has-error>
                </div>
                <div class="col-md-6">
                	<div class="bor8 how-pos4-parent">
                        <select v-model="form.city.id" name="city" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('city.id') }" id="city" required>
                        	<option disabled value="">Select your city</option>
                        	<option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                        </select>
                        <i class="how-pos4 pointer-none fa fa-map-marker"></i>
                    </div>

                    <has-error :form="form" field="city.id"></has-error>
                </div>
            </div>

            <div class="form-group m-b-20">
        		<div class="bor8 how-pos4-parent">
        			<input type="password" name="password" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('password') }" v-model="form.password" placeholder="Password" id="password" required>
        			<i class="how-pos4 pointer-none fa fa-key"></i>
        		</div>
        		
        		<has-error :form="form" field="password"></has-error>
        	</div>

        	<div class="form-group m-b-20">
        		<div class="bor8 how-pos4-parent">
        			<input type="password" name="password_confirmation" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('password_confirmation') }" v-model="form.password_confirmation" placeholder="Re-enter your password" id="password_confirmation" required>
        			<i class="how-pos4 pointer-none fa fa-check"></i>
        		</div>

        		<has-error :form="form" field="password_confirmation"></has-error>
        	</div>

        	<div class="form-group m-b-20">
        		<button type="submit" :disabled="form.busy" class="flex-c-m stext-101 cl0 size-121 bg1 bor3 hov-btn1 p-lr-15 trans-04">Register</button>
        	</div>

        	<div class="w-full">
            	<div class="flex-w w-full">
            		<a :href="openLink('login')" class="flex-c-m stext-101 cl0 size-107 bg3 bor3 hov-btn2 p-lr-15 trans-04 m-r-20">Sign In</a>
            		<a :href="openLink('password/reset')" class="flex-c-m stext-101 cl2 size-107 bg2 bor3 hov-btn1 p-lr-15 trans-04 m-r-20">Reset Password</a>
            	</div>
            </div>
        </form>
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
					role: '',
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
					html: 'Not sure? <a href="/how-it-works" target="__blank">Click here</a> to understand what each user can do',
					type: 'info',
					showCancelButton: true,
					confirmButtonText: 'Vendor',
					cancelButtonText: 'Buyer',
					reverseButtons: true
				})
				.then((result) => {
					if (result.value) {
						this.form.role = 'vendor'
					} else {
						this.form.role = 'user'
					}
					// console.log(this.form.role)

					const loader = this.$loading.show()

					this.form.city_id = this.form.city.id

					this.form.post(this.url)
					.then(() => {
						Swal.fire({
							icon: 'success',
							title: 'Yay!!!',
							text: 'You will be redirected now...'
						})

						setTimeout(() => {
							window.location.href = window.location.protocol + "//" + window.location.host + "/" + 'home'
						}, 2000)
					})
					.catch((error) => {
						console.log(error)
						Swal.fire({
							title: 'Oops...',
							text: 'Something went horribly wrong!',
							icon: 'error'
						})

						loader.hide()
					})
				})
			},
			openLink(page) {
				return '/'+page
			}
		},
		created() {
			this.loadStates()
		}
	}
</script>
