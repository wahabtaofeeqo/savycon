<template>
	<div>
		<section class="sec-relate-product bg0 p-t-45 p-b-105">
			<div class="container">
				<div class="p-b-45">
					<h3 class="ltext-106 cl5 txt-center">
						<span>{{ category.name }}</span>
					</h3>
				</div>
				
		    	<section class="bg0 p-t-23 p-b-140">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-lg-9 p-b-80">
								<div class="alert alert-info" v-show="services.length < 1">
						    		There are no services <mark>{{ search ? 'for your search' : 'in this category'}}</mark> at the moment.<br>
						    		Please check back later.
						    	</div>

						    	<div class="row isotope-grid" v-show="services.length > 0">
									<div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item" v-for="service in services">
										<div class="block2">
											<div class="block2-pic hov-img0">
												<img :src="getPhoto(service)" alt="IMG-SERVICE">

												<a :href="openService(service.id)" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
													View
												</a>
											</div>

											<div class="block2-txt flex-w flex-t p-t-14">
												<div class="block2-txt-child1 flex-col-l ">
													<small class="cl3 p-b-6">
														<i class="fa fa-map-marker"></i> {{ service.city.name }}, {{ service.city.state.name }}
													</small>
													<span class="stext-105 cl3">
														<a :href="openService(service.id)" class="stext-104 cl2 hov-cl1 trans-04 js-name-b2 p-b-6">{{ service.title }}</a> <br>
														<small>
															<a :href="'/category/'+service.service.category.id" class="cl4">
																<img :src="'/images/tags/'+service.service.category.image_tag" width="10" height="10" style="border-radius: 25%;"> {{ service.service.category.name }}
															</a>
														</small>
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
										<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" v-model="search" @keyup.enter="searchServices" name="search" placeholder="Search">

										<button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04" @click="searchServices">
											<i class="zmdi zmdi-search"></i>
										</button>
									</div>

									<!-- Sub Categories -->
									<div class="p-t-50" ref="subCategoriesContainer">
										<h4 class="mtext-112 cl2 p-b-27">
											Sub-Categories
										</h4>
										<div class="alert alert-info" v-show="subCategories.length < 1">
											NONE AT THE MOMENT
										</div>

										<div class="flex-w m-r--5" v-show="subCategories.length > 0" style="max-height: 400px; overflow-y: auto;">
											<a :href="openSubCategory(sub.id)" :key="sub.id" v-for="sub in subCategories" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
												{{ sub.name.toUpperCase() }}
											</a>
										</div>
									</div>

									<!-- Featured Services -->
									<div class="p-t-65" ref="featuredContainer">
										<h4 class="mtext-112 cl2 p-b-33">
											Featured Services
										</h4>
										<div class="alert alert-info" v-show="featuredServices.length < 1">
											NONE AT THE MOMENT
										</div>

										<ul v-show="featuredServices.length > 0" style="max-height: 400px; overflow-y: auto;">
											<li class="flex-w flex-t p-b-30" v-for="service in featuredServices">
												<a :href="openService(service.id)" class="wrap-pic-w size-214 hov-ovelay1 m-r-20">
													<img :src="getPhoto(service)" alt="SERVICE">
												</a>

												<div class="size-215 flex-col-t p-t-8">
													<a :href="openService(service.id)" class="stext-116 cl8 hov-cl1 trans-04">
														{{ service.title }}
													</a>

													<span class="stext-116 cl6 p-t-20">
														<i class="fa fa-map-marker"></i> {{ service.city.name }}, {{ service.city.state.name }}
													</span>
												</div>
											</li>
										</ul>
									</div>

									<!-- Other Categories -->
									<div class="p-t-55" ref="categoriesContainer">
										<h4 class="mtext-112 cl2 p-b-33">
											Other Categories
										</h4>
										<div class="alert alert-info" v-show="categories.length < 1">
											NONE AT THE MOMENT
										</div>

										<ul v-show="categories.length > 0" style="max-height: 300px; overflow-y: auto;">
											<li class="bor18" v-for="category in categories">
												<a :href="openCategory(category.id)" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
													{{ category.name }}
												</a>
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
			'category_id',
		],

		data() {
			return {
				category: {},
				categories: [],
				subCategories: [],

				featuredServices: [],
				services: [],
				pagination: {},

				url: '/api/category/',
				categoryURL: '/api/category/show/',
				categoriesURL: '/api/category/',
				subCategoriesURL: '/api/category/services/',
				featuredServicesURL: '/api/services/featured/5',

				search: '',
			}
		},
		methods: {
			getCategory() {
				const loader = this.$loading.show({
					container: this.$refs.categoryContainer
				})

				axios.get(this.categoryURL+this.category_id)
				.then((response) => {
					this.category = response.data

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			loadCategories() {
				const loader = this.$loading.show({
					container: this.$refs.categoryContainer
				})

				axios.get(this.categoriesURL)
				.then((response) => {
					this.categories = response.data

					loader.hide()
				})
				.catch(() => {					
					loader.hide()
				})
			},
			loadSubCategories() {
				const loader = this.$loading.show({
					container: this.$refs.subCategoriesContainer
				})

				axios.get(this.subCategoriesURL+this.category_id)
				.then((response) => {
					this.subCategories = response.data

					loader.hide()
				})
				.catch(() => {					
					loader.hide()
				})
			},
			loadFeaturedServices() {
				const loader = this.$loading.show({
					container: this.$refs.featuredContainer
				})

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
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				axios.get(this.url+this.category_id)
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
			getPhoto(service) {
				var path = '/images/services/'
				
				if (service.image_1 === 'unavailable.png') {
					path = '/images/tags/'

					name = service.service.category.image_tag
				}

				return path+name
			},
			openService(id) {
				return '/service/'+id
			},
			openCategory(id) {
				return '/category/'+id
			},
			openSubCategory(id) {
				return '/sub-category/'+id
			},
			searchServices() {
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				axios.get('/api/findService/'+this.search)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			}
		},
		created() {
			this.getCategory()
			this.loadCategories()
			this.loadSubCategories()
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