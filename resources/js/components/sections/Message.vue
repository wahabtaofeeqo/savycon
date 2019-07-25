<template>
	<div>
		<div class="alert alert-success" v-show="alert">
			Thank you dropping a message.
		</div>

		<form class="w-full" @submit.prevent="sendMessage()" @keydown="form.onKeydown($event)">
			<h5 class="mtext-108 cl2 p-b-7 m-b-30 text-center">
				Drop a Message
			</h5>

			<div class="row p-b-25">
				<div class="col-12 p-b-5">
					<div class="bor8 how-pos4-parent">
            			<input type="text" name="name" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('name') }" v-model="form.name" placeholder="Full name" id="name" autofocus="on" required>
            			<i class="how-pos4 pointer-none fa fa-user"></i>
            		</div>
					<has-error :form="form" field="name"></has-error>
				</div>
			</div>

			<div class="row p-b-25">
				<div class="col-12 p-b-5">
					<div class="bor8 how-pos4-parent">
            			<input type="email" name="email" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('email') }" v-model="form.email" placeholder="Email address" id="email" required>
            			<i class="how-pos4 pointer-none fa fa-envelope"></i>
            		</div>
					<has-error :form="form" field="email"></has-error>
				</div>
			</div>

			<div class="row p-b-25">
				<div class="col-12 p-b-5">
					<div class="bor8 how-pos4-parent">
            			<input type="tel" name="phone" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('phone') }" v-model="form.phone" placeholder="Phone number" id="phone" aria-describedby="addon-phone" minlength="10" maxlength="10">
            			<span class="how-pos4 pointer-none phone"></span>
            		</div>
					<has-error :form="form" field="phone"></has-error>
				</div>
			</div>

			<div class="row p-b-25">
				<div class="col-12 p-b-5">
					<label class="stext-102 cl3" for="message">Your message</label>
					<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="message" name="message" v-model="form.message" required></textarea>
					<has-error :form="form" field="message"></has-error>
				</div>
			</div>

			<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" :disabled="form.busy">
				Submit
			</button>
		</form>
	</div>
</template>

<script>
	export default {
		props: [
			'name',
			'phone',
			'email',
			'service_id'
		],
		data() {
			return {
				alert: false,

				form: new Form({
					id: '',
					name: this.name,
					phone: this.phone,
					email: this.email,
					message: '',
					service_id: this.service_id
				}),

				url: '/api/message/',
			}
		},
		methods: {
			sendMessage() {
				const loader = this.$loading.show({
					container: this.$refs.messageContainer,
				})

				this.form.post(this.url)
				.then(() => {
					loader.hide()

					this.alert = true
					this.form.reset();
				})
				.catch(() => {
					loader.hide()

					Swal.fire({
						type: 'error',
						title: 'Something went wrong!',
						text: 'Please try again later'
					})
				})
			},
		},
	}
</script>

<style scoped>
	.phone::before {
		content: "+234";
		font-weight: 900;
		font-size: 80%;
	}
	.phone {
		top: calc(42% - 9px);
		left: 18px;
	}
</style>
