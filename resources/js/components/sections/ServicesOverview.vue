<template>
	<div>
    	<section class="bg0 p-t-50 p-b-140" id="search">
			<div class="container">
				<div class="p-b-10">
					<h3 class="ltext-103 cl5">
						Services Overview
						<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
							<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
							<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
							Search
						</div>
					</h3>
				</div>

				<!-- Categories -->
				<div class="flex-w flex-sb-m p-b-52">
					<!-- Search -->
					<div class="dis-none panel-search w-full p-t-10 p-b-15">
						<div class="bor8 dis-flex p-l-15">
							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" @click="searchServices">
								<i class="zmdi zmdi-search"></i>
							</button>

							<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" v-model="search" @keyup.enter="searchServices" name="search-service" placeholder="Search" list="available_services">
							<datalist id="available_services">
								<option :value="service.title" v-for="service in allServices"></option>
							</datalist>

							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" @click="searchServices">
								<i class="zmdi zmdi-map"></i>
							</button>

							<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" v-model="search_address" @keyup.enter="searchServices" name="" placeholder="Location" list="available_cities">
							<!-- <datalist id="available_cities">
								<option :value="city.address" v-for="city in allServices"></option>
							</datalist> -->
						</div>	
					</div>
				</div>

				<div class="alert alert-info" v-show="services.length < 1">
					No service was found <mark>{{ search ? 'for your search' : 'in this category'}}</mark>
				</div>

				<div class="row" v-show="services.length > 0">
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item" v-for="service in services">
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
				<div class="flex-c-m flex-w w-full p-t-45" v-show="pagination.next_page_url">
					<button class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04" @click="fetchPaginateServices(pagination.next_page_url)">
						Shuffle
					</button>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				categories: [],

				services: [],
				pagination: {},

				servicesURL: '/api/services',
				categoriesURL: '/api/category',

				search: '',
				search_address: '',

				allServices: [],
				allCities: [],
			}
		},
		methods: {
			getPhoto(service) {
				var path = '/images/services/'
				
				if (service.image_1 === 'unavailable.png') {
					path = '/images/tags/'

					name = service.service.category.image_tag
				}

				return path+name
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
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				axios.get(this.servicesURL)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

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
			categoriesLink() {
				return '/category'
			},
			openService(id) {
				return '/service/'+id
			},
			searchServices() {
				const loader = this.$loading.show({
					container: this.$refs.serviceContainer
				})

				axios.get('/api/findService/'+this.search+'/'+this.search_address)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			loadAllServices() {
				axios.get('/api/services/all/')
				.then((response) => {
					this.allServices = response.data
				})
			}
		},
		created() {
			Fire.$on('searching', () => {
				this.search = this.$parent.global_search				
				this.search_address = this.$parent.global_search_address		

				this.searchServices()

				window.location.hash = "search"
				$('.modal-search-header').removeClass('show-modal-search');
        		$('.js-show-modal-search').css('opacity','1');
			})
		},
		mounted() {
			this.loadCategories()
			this.loadServices()
			this.loadAllServices()
		}
	}	
</script>

<style scoped>
	.panel-search input {
		padding-left: 15px;
	}
	.panel-search input::placeholder {
		color: gray;
	}
</style>
