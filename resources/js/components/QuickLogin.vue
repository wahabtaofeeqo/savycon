<template>
	<div>
    	<alert-error :form="form"></alert-error>

        <form method="POST" @submit.prevent="loginUser()" @keydown="form.onKeydown($event)">
            <div class="form-group" style="margin-bottom: 20px;">
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107" type="email" name="email" placeholder="email@example.com" :class="{ 'has-error':form.errors.has('email') }" v-model="form.email" required>
                        <div class="focus-input1 trans-04"></div>
                        <has-error :form="form" field="email"></has-error>
                    </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107" type="password" name="password" placeholder="Your password" :class="{ 'has-error':form.errors.has('password') }" v-model="form.password" required>
                        <div class="focus-input1 trans-04"></div>
                        <has-error :form="form" field="password"></has-error>
                    </div>
            </div>
            <div class="form-group">
				<button type="submit" :disabled="form.busy" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn1 p-lr-15 trans-04">Login</button>
            </div>
        </form>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				form: new Form({
					email: '',
					password: '',
				}),

				url: '/login',
			}
		},
		methods: {
			loginUser() {
				const loader = this.$loading.show()

				this.form.post(this.url)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Welcome back!!!',
						text: 'We will refresh the page now...'
					})

					loader.hide()
					this.form.busy = true

					setTimeout(() => {
						window.location.href = '/'
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
			}
		},
	}
</script>