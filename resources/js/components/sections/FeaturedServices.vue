<template>
	<div>
    	<section class="sec-product bg0 p-t-100 p-b-50">
			<div class="container">
		        <div class="p-b-32">
	                <h3 class="ltext-105 cl5 txt-center respon1">
                        Featured Services
	                </h3>
		        </div>

		        <div class="alert alert-info" v-show="services.length < 1">
		        	There are no featured services at the moment
		        </div>

		        <div class="wrap-slick2" v-show="services.length > 0">
					<div class="slick2">
						<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15" v-for="service in services">
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img :src="getPhoto(service.image_1)" alt="IMG-SERVICE">

									<a :href="openService(service.id)" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										View
									</a>
								</div>
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a :href="openService(service.id)" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											{{ service.title }}
										</a>
										<span class="stext-105 cl3">
											₦{{ service.price }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
		        </div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				services: {},

				servicesURL: '/api/services/featured',
			}
		},
		methods: {
			getPhoto(name) {
				return '/images/services/'+name
			},
			loadServices() {
				const loader = this.$loading.show()

				axios.get(this.servicesURL)
				.then((response) => {
					this.services = response.data.data

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'Service data cannot be collected at the moment'
					})

					loader.hide()
				})
			},
			openService(id) {
				return '/service/'+id
			}
		},
		created() {
			this.loadServices()
		}
	}
</script>
