<template>
	<div>
		<section class="sec-relate-product bg0 p-t-45 p-b-105">
			<div class="container">
				<div class="p-b-45">
					<h3 class="ltext-106 cl5 txt-center">
						<span>{{ subCategory.name }}</span>
					</h3>
				</div>

		    	<section class="bg0 p-t-23 p-b-140">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-lg-9 p-b-80">
								<div class="alert alert-info" v-show="services.length < 1">
						    		There are no services in this category at the moment.<br>
						    		Please check back later.
						    	</div>

						    	<div class="row isotope-grid" v-show="services.length > 0">
									<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item" v-for="service in services">
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

								<!-- Pagination -->
								<div class="flex-c-m flex-w w-full p-t-38" v-show="pagination.next_page_url">
									<button class="flex-c-m how-pagination1 trans-04 m-all-7" @click="fetchPaginateServices(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
										<i class="fa fa-arrow-left"></i>
									</button>

									<button class="flex-c-m how-pagination1 trans-04 m-all-7" @click="fetchPaginateServices(pagination.next_page_url)" :disabled="!pagination.next_page_url">
										<i class="fa fa-arrow-right"></i>
									</button>
								</div>
							</div>

							<div class="col-md-4 col-lg-3 p-b-80">
								<div class="side-menu">
									<!-- Search -->
									<div class="bor17 of-hidden pos-relative">
										<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

										<button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
											<i class="zmdi zmdi-search"></i>
										</button>
									</div>

									<!--Main Category -->
									<div class="p-t-55">
										<h4 class="mtext-112 cl2 p-b-33">
											Main Category
										</h4>
										<ul>
											<li class="bor18">
												<a :href="openCategory(subCategory.category.id)" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
													{{ subCategory.category.name }}
												</a>
											</li>
										</ul>
									</div>

									<!-- Featured Services -->
									<div class="p-t-65">
										<h4 class="mtext-112 cl2 p-b-33">
											Featured Services
										</h4>
										<div class="alert alert-info" v-show="featuredServices.length < 1">
											NONE AT THE MOMENT
										</div>

										<ul v-show="featuredServices.length > 0">
											<li class="flex-w flex-t p-b-30" v-for="service in featuredServices">
												<a :href="openService(service.id)" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
													<img :src="getPhoto(service.image_1)" alt="SERVICE">
												</a>

												<div class="size-215 flex-col-t p-t-8">
													<a :href="openService(service.id)" class="stext-116 cl8 hov-cl1 trans-04">
														{{ service.title }}
													</a>

													<span class="stext-116 cl6 p-t-20">
														₦{{ service.price }}
													</span>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		props: [
			'sub_category_id',
		],

		data() {
			return {
				subCategory: {},

				featuredServices: [],
				services: [],
				pagination: {},

				url: '/api/sub-category/',
				subCategoryURL: '/api/sub-category/show/',
				featuredServicesURL: '/api/services/featured/5',
			}
		},
		methods: {
			getSubCategory() {
				const loader = this.$loading.show()

				axios.get(this.subCategoryURL+this.sub_category_id)
				.then((response) => {
					this.subCategory = response.data

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			loadFeaturedServices() {
				const loader = this.$loading.show()

				axios.get(this.featuredServicesURL)
				.then((response) => {
					this.featuredServices = response.data

					loader.hide()
				})
				.catch(() => {					
					loader.hide()
				})
			},
			loadServices() {
				const loader = this.$loading.show()

				axios.get(this.url+this.sub_category_id)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			makePagination(data) {
				let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    total_pages: data.total,
                };

                this.pagination = pagination;
			},
			fetchPaginateServices(url) {
				this.url = url;
                this.loadServices();
			},
			getPhoto(name) {
				return '/images/services/'+name
			},
			openService(id) {
				return '/service/'+id
			},
			openCategory(id) {
				return '/category/'+id
			},
			openSubCategory(id) {
				return '/sub-category/'+id
			}
		},
		created() {
			this.getSubCategory()
			this.loadFeaturedServices()
			this.loadServices()
		}
	}	
</script>

<style scoped>
	.isotope-grid {
		min-height: 429.344px !important;
	}
</style>