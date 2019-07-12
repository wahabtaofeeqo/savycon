<template>
	<div>
    	<section class="bg0 p-t-23 p-b-140">
			<div class="container">
				<div class="p-b-10">
					<h3 class="ltext-103 cl5">
						Services Overview
					</h3>
				</div>

				<!-- Categories -->
				<div class="flex-w flex-sb-m p-b-52">
					<div class="flex-w flex-l-m filter-tope-group m-tb-10">
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" @click="loadServices" data-filter="*">
							All Categories
						</button>

						<span v-for="category in categories">
							<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" @click="switchCategory(category.id)" :data-filter="categoryName(category.name)">
								{{ category.name }}
							</button>
						</span>
					</div>

					<!-- Search -->
					<div class="flex-w flex-c-m m-tb-10">
						<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
							<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
							<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
							Search
						</div>
					</div>
					<div class="dis-none panel-search w-full p-t-10 p-b-15">
						<div class="bor8 dis-flex p-l-15">
							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
								<i class="zmdi zmdi-search"></i>
							</button>

							<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
						</div>	
					</div>
				</div>

				<div class="alert alert-info" v-show="services.length < 1">
					There are no services yet in this category
				</div>

				<div class="row isotope-grid" v-show="services.length > 0">
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item design" v-for="service in services">
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img :src="getPhoto(service.image_1)" alt="IMG-SERVICE">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									Quick View
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

				<!-- Load more -->
				<div class="flex-c-m flex-w w-full p-t-45" v-show="services.length > 0">
					<a :href="categoriesLink()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
						Load More
					</a>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				categories: {},
				services: {},

				servicesURL: '/services',
				categoriesURL: '/category',
			}
		},
		methods: {
			getPhoto(name) {
				return '/images/services/'+name
			},
			loadCategories() {
				axios.get(this.categoriesURL)
				.then((response) => {
					this.categories = response.data
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'Category data cannot be collected at the moment'
					})
				})
			},
			categoryName(name) {
				return '.'+name.toLowerCase().trim()
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
			switchCategory(id) {
				const loader = this.$loading.show()

				axios.get(this.categoriesURL+'/'+id)
				.then((response) => {			
					this.services = response.data.data

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			categoriesLink() {
				return '/category'
			},
			openService(id) {
				return '/service/'+id
			}
		},
		created() {
			this.loadCategories()
			this.loadServices()
		}
	}
</script>

<style scoped>
	.isotope-grid {
		height: 429.344px !important;
	}
</style>