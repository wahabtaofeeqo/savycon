<template>
	<div>
		<div class="col-md-6 col-lg-4 mx-auto" style="overflow: hidden;">

			<div class="card">
				<div class="header">
					<h4 class="card-title" style="padding-top: 0; margin-top: 0;">
						Promote <b>{{service.title}} </b> Service
					</h4>
				</div>
				<div class="content" style="overflow: hidden;">

					<img :src="setPath()" style="height: 150px;" alt="Service Logo">

					<p class="card-text small" style="padding: 10px 0px;">
						Select a promotion plan to feature you service on the website for a specified number of days. Week (7 days) and Month (30 days)
					</p>

					<div class="form-group">
						<label>Promotion Package</label>
						<select name="package" class="form-control" v-model="package">
							<option value="" disabled="">Select a Package</option>
							<option value="week">Week - #2, 000</option>
							<option value="month">Month - #6,000</option>
						</select>
					</div>

					<button class="btn btn-block btn-primary" @click="process">Continue</button>
				</div>
			</div>

		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {

				service: {},
				serviceID: '',

				package: '',

				url: '/api/service',

				user: {},
			}
		},

		methods: {
			loadService(id) {
				const loader = this.$loading.show()

				axios.get(this.url + '/' + id)
				.then((response) => {
					console.log(response.data);
					this.service = response.data;
					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not find the service you are looking for'
					})
				})
				.finally(() => {
					loader.hide();
				})
			},

			getUser() {
				axios.get('/api/profile')
				.then((response) => {
					this.user = response.data;
				})
				.catch(() => {})
			},

			setPath() {
				return "/images/services/" + this.service.image_3;
			},

			process() {
				if (this.package != '') {
					const data = {
						amount: (this.package == 'month') ? 6000 : 2000,
						email: this.user.email,
						phone: this.user.phone_number,
						name: this.user.name,
						id: this.serviceID,
						package: this.package
					}

					this.makePayment(data);
				}
			},

			makePayment(info) {
			    FlutterwaveCheckout({
			      	public_key: "FLWPUBK-3df0eb38dcdc8322952c52b996faa710-X", 
			      	tx_ref: "hooli-tx-1920bbtyt",
			      	amount: info.amount,
			      	currency: "NGN",
			      	country: "NG",
			      	payment_options: "card, mobilemoneyghana, ussd",
			      	customer: {
			        	email: info.email,
			        	phone_number: info.phone,
			        	name: info.name,
			      	},
			      	callback: function (data) {

			        	if (data.status == "successful") {

			        		const post = {
			        			transaction: data.transaction_id,
			        			ref: data.flw_ref,
			        			id: info.id,
			        			package: info.package,
			        			type: 'advert',
			        			amount: info.amount
			        		};

			        		axios.post("/api/feature/service", post)
					        .then((response) => {
					        	Swal.fire({
						            icon: "success",
						            title: "Payment made and Service has been featured!",
						        });
						        
						        window.location.href = "/invoice/" + info.id;
						        //Fire.$emit('refreshProfile');
					        })
					        .catch(() => {
					          Swal.fire({
					            type: "error",
					            title: "Oops...",
					            text: "We could not feature the service at the moment",
					          });
					        });
			        	}
			      	},
			      	onclose: function() {
			        	console.log("Closed");
			      	},
			      	customizations: {
			        	title: "Advertisement Fee",
			        	description: "Payment for prodcuts been advertised.",
			      	},
			    });
			},
		},

		mounted() {},

		created() {
			
			this.serviceID = this.$route.params.id;
			this.loadService(this.serviceID);
			this.getUser();
		}
	}
</script>