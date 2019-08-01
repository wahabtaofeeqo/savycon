<template>
	<div>
		<div class="row">
			<div class="container-fluid">
				<div class="col-lg-4 col-sm-6" ref="totalStatesContainer">
					<div class="alert alert-danger" v-show="total_states_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-map text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total States</p>
                                        <h4 class="card-title">{{ total_states }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminStates' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> States
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalCitiesContainer">
                	<div class="alert alert-danger" v-show="total_cities_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-map-2 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Cities</p>
                                        <h4 class="card-title">{{ total_cities }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminCities' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Cities
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalCategoriesContainer">
					<div class="alert alert-danger" v-show="total_categories_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-way text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Categories</p>
                                        <h4 class="card-title">{{ total_categories }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminCategories' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Categories
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalSubCategoriesContainer">
                	<div class="alert alert-danger" v-show="total_sub_categories_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-way text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Sub Categories</p>
                                        <h4 class="card-title">{{ total_sub_categories }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminCategories' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Categories
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-sm-6" ref="totalServicesContainer">
                    <div class="alert alert-danger" v-show="total_services_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-portfolio text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Services</p>
                                        <h4 class="card-title">{{ total_services }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminServices' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Services
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="featuredServicesContainer">
                    <div class="alert alert-danger" v-show="total_featured_services_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-portfolio text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Featured Services</p>
                                        <h4 class="card-title">{{ featured_services }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminServices' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Services
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="bannedServicesContainer">
                    <div class="alert alert-danger" v-show="total_banned_services_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-portfolio text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Banned Services</p>
                                        <h4 class="card-title">{{ banned_services }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminServices' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Services
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalBuyersContainer">
                    <div class="alert alert-danger" v-show="total_buyers_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-users text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Buyers</p>
                                        <h4 class="card-title">{{ total_buyers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminUsers' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Buyers
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalVendorsContainer">
                    <div class="alert alert-danger" v-show="total_vendors_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-users text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Vendors</p>
                                        <h4 class="card-title">{{ total_vendors }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminVendors' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Vendors
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="suspendedVendorsContainer">
                    <div class="alert alert-danger" v-show="total_suspended_vendors_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-users text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Suspended Vendors</p>
                                        <h4 class="card-title">{{ suspended_vendors }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminVendors' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Vendors
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalVendorMessagesContainer">
                    <div class="alert alert-danger" v-show="total_vendor_messages_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-chat text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Vendor Messages</p>
                                        <h4 class="card-title">{{ total_vendor_messages }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminMessages' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Messages
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalSubscribersContainer">
                    <div class="alert alert-danger" v-show="total_subscribers_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-news-paper text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Subscribers</p>
                                        <h4 class="card-title">{{ total_subscribers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminSubscribers' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Subscribers
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalContactMessagesContainer">
                    <div class="alert alert-danger" v-show="total_contact_messages_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-phone text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Total Contact Messages</p>
                                        <h4 class="card-title">{{ total_contact_messages }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminContactMessages' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Contact Messages
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalBuyerRequestsContainer">
                    <div class="alert alert-danger" v-show="total_buyer_requests_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-speaker text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Buyer's Requests</p>
                                        <h4 class="card-title">{{ buyers_requests }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminBuyerRequests' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Buyer's Requests
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalUnfoundSearchesContainer">
                    <div class="alert alert-danger" v-show="total_unfound_searches_error">
						We could not load these data
					</div>
					<div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-search text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Unfound Searches</p>
                                        <h4 class="card-title">{{ unfound_searches }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'AdminUnfoundSearches' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Unfound Searches
                            	</div>
                            </router-link>
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
				total_states: 0,
				total_states_error: false,
				total_cities: 0,
				total_cities_error: false,

				total_categories: 0,
				total_categories_error: false,
				total_sub_categories: 0,
				total_sub_categories_error: false,

				total_services: 0,
				total_services_error: false,
				featured_services: 0,
				total_featured_services_error: false,
				banned_services: 0,
				total_banned_services_error: false,

				total_vendors: 0,
				total_vendors_error: false,
				suspended_vendors: 0,
				total_suspended_vendors_error: false,
				total_buyers: 0,
				total_buyers_error: false,
				total_subscribers: 0,
				total_subscribers_error: false,

				total_contact_messages: 0,
				total_contact_messages_error: false,
				total_vendor_messages: 0,
				total_vendor_messages_error: false,

				unfound_searches: 0,
				total_unfound_searches_error: false,
				buyers_requests: 0,
				total_buyer_requests_error: false,
			}
		},
		methods: {
			getTotalStates() {
				axios.get('/api/counter/states/')
				.then(response => {
					this.total_states = response.data
				})
				.catch(() => {
					this.total_states_error = true
				})
			},
			getTotalCities() {
				axios.get('/api/counter/cities/')
				.then(response => {
					this.total_cities = response.data
				})
				.catch(() => {
					this.total_cities_error = true
				})
			},

			getTotalCategories() {
				axios.get('/api/counter/categories/')
				.then(response => {
					this.total_categories = response.data
				})
				.catch(() => {
					this.total_categories_error = true
				})
			},
			getTotalSubCategories() {
				axios.get('/api/counter/sub-categories/')
				.then(response => {
					this.total_sub_categories = response.data
				})
				.catch(() => {
					this.total_sub_categories_error= true
				})
			},

			getTotalServices() {
				axios.get('/api/counter/services/')
				.then(response => {
					this.total_services = response.data
				})
				.catch(() => {
					this.total_services_error = true
				})
			},
			getTotalFeaturedServices() {
				axios.get('/api/counter/services/featured')
				.then(response => {
					this.featured_services = response.data
				})
				.catch(() => {
					this.total_featured_services_error = true
				})
			},
			getTotalBannedServices() {
				axios.get('/api/counter/services/banned')
				.then(response => {
					this.banned_services = response.data
				})
				.catch(() => {
					this.total_banned_services_error = true
				})
			},

			getTotalVendors() {
				axios.get('/api/counter/vendors/')
				.then(response => {
					this.total_vendors = response.data
				})
				.catch(() => {
					this.total_vendors_error = true
				})
			},
			getTotalSuspendedVendors() {
				axios.get('/api/counter/vendors/suspended')
				.then(response => {
					this.suspended_vendors = response.data
				})
				.catch(() => {
					this.total_suspended_vendors_error = true
				})
			},
			getTotalBuyers() {
				axios.get('/api/counter/buyers/')
				.then(response => {
					this.total_buyers = response.data
				})
				.catch(() => {
					this.total_buyers_error = true
				})
			},
			getTotalSubscribers() {
				axios.get('/api/counter/subscribers/')
				.then(response => {
					this.total_subscribers = response.data
				})
				.catch(() => {
					this.total_subscribers_error = true
				})
			},

			getTotalContactMessages() {
				axios.get('/api/counter/messages/contact')
				.then(response => {
					this.total_contact_messages = response.data
				})
				.catch(() => {
					this.total_contact_messages_error = true
				})
			},
			getTotalVendorMessages() {
				axios.get('/api/counter/messages/vendor')
				.then(response => {
					this.total_vendor_messages = response.data
				})
				.catch(() => {
					this.total_vendor_messages_error = true
				})
			},

			getTotalUnfoundSearches() {
				axios.get('/api/counter/unfound-searches')
				.then(response => {
					this.unfound_searches = response.data
				})
				.catch(() => {
					this.total_unfound_searches_error = true
				})
			},
			getTotalBuyerRequests() {
				axios.get('/api/counter/buyer-requests')
				.then(response => {
					this.buyers_requests = response.data
				})
				.catch(() => {
					this.total_buyer_requests_error = true
				})
			},
		},
		created() {
			this.getTotalStates()
			this.getTotalCities()

			this.getTotalCategories()
			this.getTotalSubCategories()

			this.getTotalServices()
			this.getTotalFeaturedServices()
			this.getTotalBannedServices()

			this.getTotalVendors()
			this.getTotalSuspendedVendors()
			this.getTotalBuyers()

			this.getTotalSubscribers()
			this.getTotalContactMessages()
			this.getTotalVendorMessages()

			this.getTotalUnfoundSearches()
			this.getTotalBuyerRequests()
		},
		mounted() {

		}
	}
</script>