<template>
	<div style="">
		<div class="col-sm-12 col-md-8 col-lg-6 mx-auto" style="overflow: hidden;">

			<div class="card">
				<div class="header">
					<h4 class="card-title" style="padding-top: 0; margin-top: 0;">
						Service Link!
					</h4>
				</div>
				<div class="content" style="overflow: hidden;">

					<form @submit.prevent="createLink">
						<div class="form-group">
							<label for="Service">Service</label>
							<input type="text" name="service" placeholder="Service" v-model="form.service" required class="form-control">
						</div>

						<div class="form-group">
							<label for="price">Price</label>
							<input type="number" name="price" placeholder="Service Price" v-model="form.price" required class="form-control">
						</div>

						<div class="form-group">
							<label for="currency">Currency</label>
							<select v-model="form.currency" name="currency" class="form-control" id="currency" required>
								<option disabled value="">Select your Currency</option>
		                        <option v-for="c in currencies" :key="c.code" :value="c.code">{{ c.code }}</option>
							</select>
						</div>						

						<div class="form-group">
							<label for="Service">Description</label>
							<textarea required v-model="form.description" name="desc" rows="4" placeholder="Description" class="form-control"></textarea>
						</div>
						
						<button :disable="form.busy" class="btn btn-block btn-primary mx-5">Continue</button>
					</form>
				</div>
			</div>

			<p class="text-primary">
				{{link}}
				<button v-if="link != ''" class="btn btn-info btn-sm mx-3" @click="copyLink">Copy</button>
			</p>
		</div>
	</div>
</template>

<script>
	export default {
		methods: {
			createLink() {
				const loader = this.$loading.show();
				console.log(this.form);
				axios.post('/api/service-link', this.form)
				.then((response) => {
					this.form.reset();
					this.link = response.data.link;
				})
				.catch(err => {
					Swal.fire({
						icon: 'error',
					  	title: 'Please try again.',
					});
				})
				.finally(() => {
					loader.hide();
				})
			},

			copyLink: function () {
		      	this.$copyText(this.link).then(
		        	function (e) {
		          		this.toast("Phone number Copied", 'success');
		        	},
		        	function (e) {
		          		this.toast("Can not copy", 'error');
		        	}
		      	);
		    },

		    toast(message, type) {
				Swal.fire({
                    text: message,
                    toast: true,
                    position: 'bottom-right',
                    showConfirmButton: false,
                    timer: 3000,
                    icon: type
                });
			}
		},
		data() {
			return {
				form: new Form({
					service: '',
					price: '',
					description: '',
					currency: '',
				}),

				link: '',

				currencies: [
					{
						code: 'NGN'
					},
					{
						code: 'USD'
					}
				]
			}
		},
		created() {}
	}
</script>