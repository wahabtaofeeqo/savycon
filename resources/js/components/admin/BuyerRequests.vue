<template>
	<div>
		<div class="alert alert-info">
			<span>We bring to you the buyers in need of a service ONLY in your city</span>
		</div>

		<div class="alert alert-danger" v-show="requests.length < 1">
			<p>We have no buyer requests for you at the moment.</p>
		</div>

		<div v-show="requests.length > 0">
			<div class="row">
				<div class="col-md-4" v-for="(request, index) in requests">
					<div class="card">
						<div class="header">
							<h4 class="title">{{ index+1 }}</h4>
							<p class="category">{{ request.service.category.name }} > {{ request.service.name }}</p>
						</div>
						<div class="content">
							<div class="form-group">
								<label for="title">Title</label>
								<p id="title">{{ request.title }}</p>
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<p id="description">{{ request.description }}</p>
							</div>
							<div class="form-group">
								<label for="price">Budget</label>
								<p id="price">₦{{ request.price }}</p>
							</div>

							<a :href="call(request.user.phone)" class="btn btn-info btn-fill" title="Call"><i class="fa fa-phone"></i></a>
							<a :href="whatsapp(request.user.phone)" class="btn btn-primary btn-fill" title="Text on WhatsApp"><i class="fa fa-whatsapp"></i></a>
							<a :href="mail(request.user.email)" class="btn btn-success btn-fill" title="Send Mail"><i class="fa fa-envelope"></i></a>
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
				requests: {},
				pagination: [],

				url: '/api/user-requests',
			}
		},
		methods: {
			loadRequests() {
				const loader  = this.$loading.show()

				axios.get(this.url)
				.then((response) => {
					this.requests = response.data.data

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Something went wrong',
						text: 'We could not load the requests at the moment'
					})

					loader.hide()
				})
			},
			call(phone) {
				return 'tel:234'+phone;
			},
			whatsapp(phone) {
				return 'https://api.whatsapp.com/send?phone=234'+phone;
			},
			mail(email) {
				return 'mailto:'+email;
			},
		},
		created() {
			this.loadRequests()
		},
		mounted() {

		}
	}
</script>