<template>
	<div>
		<div class="col-md-6 mx-auto">

			<div class="card">
				<div class="card-header d-none">
					<h4 class="card-title mb-0">Do</h4>
				</div>

				<div class="card-body">
					<p class="card-subtitle text-center py-3 mb-4">
						Support Donation!
					</p>

					<form method="POST" @submit.prevent="makeDonation()" @keydown="form.onKeydown($event)">
			        	<div class="form-group m-b-20">
			        		<div class="bor8 how-pos4-parent">
			        			<input type="email" name="email" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('email') }" v-model="form.email" placeholder="Your Email" id="email" autofocus="on" required>
			        			<i class="how-pos4 pointer-none fa fa-user"></i>
			        		</div>

			        		<has-error :form="form" field="email"></has-error>
			        	</div>

			        	<div class="form-group m-b-20">
			        		<div class="bor8 how-pos4-parent">
			        			<input type="number" name="amount" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('amount') }" v-model="form.amount" placeholder="Amount" id="amount" required>
			        			<i class="how-pos4 pointer-none fa fa-money"></i>
			        		</div>

			        		<has-error :form="form" field="amount"></has-error>
			        	</div>

			        	<div class="form-group m-b-20">
			        		<div class="bor8 how-pos4-parent">
			        			<input type="tel" name="phone" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('phone') }" v-model="form.phone" placeholder="Phone number" id="phone" aria-describedby="addon-phone" minlength="10" maxlength="10" required>
			        			<span class="how-pos4 pointer-none phone"></span>
			        		</div>

			        		<has-error :form="form" field="phone"></has-error>
			        	</div>

			        	<div class="form-group m-b-20">
		                	<div class="bor8 how-pos4-parent">
		                        <select v-model="form.currency" name="currency" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" :class="{ 'has-error':form.errors.has('currency') }" id="currency" required>
		                        	<option disabled value="">Select your Currency</option>
		                        	<option v-for="c in currencies" :key="c.code" :value="c.code">{{ c.code }}</option>
		                        </select>
		                        <i class="how-pos4 pointer-none fa fa-money"></i>
		                    </div>

		                    <has-error :form="form" field="currency"></has-error>
		                </div>

			        	<div class="form-group m-b-20">
			        		<button type="submit" :disabled="form.busy" class="flex-c-m stext-101 cl0 size-121 bg1 bor3 hov-btn1 p-lr-15 trans-04">Continue</button>
			        	</div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import paystack from 'vue-paystack';
	export default {
		components: {
	        paystack
	    },
	    
		data() {
			return {
				paystackkey: "pk_test_379e4193510b67197fa56d8783f3c64e3386d3e7", //paystack public key
          		email: "foobar@example.com", // Customer email
          		amount: 1000000, // in kobo

          		form: new Form({	
					email: '',
					phone: '',
					amount: '',
					currency: '',
				}),

				user: {},

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

		methods: {

			loadUser() {
            	const loader = this.$loading.show()

				axios.get('/api/profile')
				.then((response) => {
					this.user = response.data;
				})
				.catch(() => {
			
				})
				.finally(() => {
					loader.hide();
				})
            },

		    makeDonation() {
		    	this.makePayment()
		    },

		    makePayment() {

		    	const form = this.form;
		    	this.form.reset();
		    	
		    	form.user = this.user.id;

			    FlutterwaveCheckout({
			      	public_key: "FLWPUBK_TEST-fec63da3bb65c48db6b9f1421164a2c1-X", 
			      	tx_ref: "hooli-tx-1920bbtyt",
			      	amount: this.form.amount,
			      	currency: this.form.currency,
			      	country: (this.form.currency == "NGN") ? "NG" : "US",
			      	payment_options: "card, mobilemoneyghana, ussd",
			      	customer: {
			        	email: this.form.email,
			        	phone_number: this.form.phone,
			        	name: "Donator",
			      	},
			      	callback: (data) => {
			      		
			      		const post = {
			        		transaction: data.transaction_id,
			        		ref: data.flw_ref,
			        		type: 'donation',
			        		amount: this.form.amount,
			        		user: this.form.user
			        	};

			      		axios.post('/api/add-donator', post)
			      		.then(response => {
			      			location.href = '/thank-you';
			      		})
			      		.catch(err => {
			      			console.log(err);
			      		})
			      	},
			      	onclose: function() {
			        	//location.reload();
			      	},
			      	customizations: {
			        	title: "Donation",
			        	description: "Payment for donation on Savycon",
			      	},
			    });
			},
		},

		computed: {
			reference(){
		        let text = "";
		        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		 
		        for( let i=0; i < 10; i++ )
		          text += possible.charAt(Math.floor(Math.random() * possible.length));
		 
		        return text;
		    }
		},

		mounted() {},

		created() {
			this.loadUser();
		}
	}
</script>