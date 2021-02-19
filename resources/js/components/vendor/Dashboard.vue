<template>
	<div>
		<blockquote v-if="user.active == 0">
			<h1>Your account has been suspended!</h1>
			<h4>Please <a href="/contact" target="__blank">submit a query</a> for the administrator</h4>
		</blockquote>

		<div class="row" v-else>
			<div class="container-fluid">
				<div class="col-lg-4">
					<a :href="openServices()" target="__blank" class="btn btn-lg btn-fill btn-primary">Open Services Profile</a>
				</div>
				<div class="col-lg-4 col-sm-6" ref="totalServicesContainer">
					<div class="alert alert-danger" v-show="total_services_error">
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
                                        <p class="card-category">Total Services</p>
                                        <h4 class="card-title">{{ total_services }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'VendorServices' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Services
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" ref="totalRatingContainer">
					<div class="alert alert-danger" v-show="total_rating_error">
						We could not load these data
					</div>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="pe-7s-like2 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="numbers">
                                        <p class="card-category">Average Rating</p>
                                        <h4 class="card-title">{{ total_rating }}/5</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                        	<router-link :to="{ name: 'VendorServices' }">
                            	<div class="stats">
                            		<i class="fa fa-link"></i> Services
                            	</div>
                            </router-link>
                        </div>
                    </div>
                </div>

                <div v-show="messages.length > 0" ref="messageContainer">
                	<div class="col-md-12">
                		<h4 class="page-header">Your customers are trying to connect...</h4>
                		<div class="alert alert-info">
                			Please resolve as soon as you contact them
                		</div>
                	</div>
                	<div class="col-md-4" v-for="(message, index) in messages" :key="message.id">
						<div class="card">
							<div class="header">
								<h4 class="title">
									{{ index+1 }}
									<span class="pull-right">
										<a :href="viewService(message.user_service.id)" target="__blank" class="btn btn-danger btn-sm btn-fill" title="View Service">View Service</a>
										<button class="btn btn-sm btn-success btn-fill" @click="resolveMessage(message.id)">Resolve</button>
									</span>
									<div class="clearfix"></div>
								</h4>
								<p class="category">{{ message.user_service.service.category.name }} > {{ message.user_service.service.name }}</p>
							</div>
							<div class="content">
								<div class="form-group">
									<label>Name</label>
									<p>{{ message.name }}</p>
								</div>
								<div class="form-group">
									<label>Email</label>
									<p>{{ message.email }}</p>
								</div>
								<div class="form-group">
									<label>Phone number</label>
									<p>0{{ message.phone }}</p>
								</div>
								<div class="form-group">
									<label>Message</label>
									<p style="white-space: pre-line;">{{ message.message }}</p>
								</div>

								<a :href="call(message.phone)" target="__blank" class="btn btn-info btn-fill" title="Call"><i class="fa fa-phone"></i></a>
								<a :href="whatsapp(message.phone)" target="__blank" class="btn btn-primary btn-fill" title="Text on WhatsApp"><i class="fa fa-whatsapp"></i></a>
								<a :href="mail(message.email)" target="__blank" class="btn btn-success btn-fill" title="Send Mail"><i class="fa fa-envelope"></i></a>
							</div>
						</div>
					</div>
                </div>

                <!-- Adverts -->
                <div class="row" v-show="adverts.length > 0" ref="advertsContainer">
                	<div class="col-sm-12">
                		<h4 class="text-primary">Featured Adverts</h4>
                	</div>
                    <div class="col-md-4 col-lg-4" v-for="advert in adverts" :key="advert.id">
                        <div class="card card-user">
                            <div class="card-image">
                                <a :href="advert.URL">
                                	<img :src="viewAdvertImage(advert.image)" alt="..." width="100%" height="auto">
                                </a>
                            </div>
                            <div class="card-body" style="padding: 10px;">
                                <div class="author" style="text-align: left;">
                                    <a :href="advert.URL">
                                        <h4 class="title">{{ advert.title }}</h4>
                                    </a>
                                </div>
                                <p class="description">
                                    {{ advert.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buyers Requests -->
                <h4 class="text-primary">Nearby Buyer's Requests</h4>
                <div class="row" v-show="userRequests.length > 0">
                    <div class="col-md-4 col-lg-4" v-for="userRequest in userRequests" :key="userRequest.id">
                    	<div class="card">
		                    <div class="card-body" style="padding: 5%;">
		                    	<div style="font-weight: bold; font-size: 130%; margin-bottom: 10px;">{{ userRequest.title }}</div>
		                        <div v-html="userRequest.description.substr(0, 200)"></div>
		                        <p>
		                        	<a :href="'/buyers-requests/'+userRequest.id" target="__blank" class="btn btn-primary btn-sm btn-fill">View Request</a>
		                        </p>
		                    </div>
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
				user: {},
				url: '/api/profile',

				total_services: 0,
				total_services_error: false,

				total_rating: 0,
				total_rating_error: false,

				messages: [],
				messagesURL: '/api/vendor/messages/',

				adverts: [],
				advertURL: '/api/adverts/dashboard/6',

				userRequests: []
			}
		},
		methods: {
			getUserData() {
				const loader = this.$loading.show()

				axios.get(this.url)
				.then((response) => {
					this.user = response.data

					if (this.user.active === 1) {
						this.getTotalServices()
						this.getAverageRating()
						this.getMessages()
					}

					loader.hide()
				})
				.catch(() => {
					loader.hide()
				})
			},
			openServices() {
				return '/services/user/'+this.user.id
			},

			getTotalServices() {
				const loader = this.$loading.show({
					container: this.$refs.totalServicesContainer
				})

				axios.get('/api/counter/vendor/services/')
				.then(response => {
					this.total_services = response.data

					loader.hide()
				})
				.catch(() => {
					this.total_services_error = true

					loader.hide()
				})
			},
			getAverageRating() {
				const loader = this.$loading.show({
					container: this.$refs.totalRatingContainer
				})

				axios.get('/api/counter/vendor/rating/')
				.then(response => {
					this.total_rating = response.data

					loader.hide()
				})
				.catch(() => {
					this.total_rating_error = true

					loader.hide()
				})
			},

			getMessages() {
				const loader = this.$loading.show({
					container: this.$refs.messageContainer
				})

				axios.get(this.messagesURL)
				.then((response) => {
					this.messages = response.data[0]

					loader.hide()
				})
				.catch(() => {
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
			viewService(id) {
				return '/service/'+id;
			},
			resolveMessage(id) {
				const loader = this.$loading.show()

				axios.delete('/api/message/'+id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'Message was resolved successfully'
					})

					Fire.$emit('refreshMessages')

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Message could not be resolved'
					})

					loader.hide()
				})
			},

			loadAdverts() {
				const loader = this.$loading.show({
					container: this.$refs.advertsContainer
				})

				axios.get(this.advertURL)
				.then((response) => {
					this.adverts = response.data

					loader.hide()
				})
			},
			viewAdvertImage(image) {
				return '/images/adverts/'+image
			},
			loadRequests() {
				axios.get('/api/vendors/requests')
				.then((response) => {
					this.userRequests = response.data.data
				})
			},
		},
		created() {
			this.getUserData()
			this.loadAdverts()
			this.loadRequests()

			Fire.$on('refreshMessages', () => {
				this.loadMessages()
			})	
		},
	}
</script>