<template>
	<div>
		<!-- Adverts -->
        <div class="row" v-if="adverts.length > 0" ref="advertsContainer">
        	<div class="col-sm-12">
        		<h4 class="text-primary">Featured Adverts</h4>
        	</div>
            <div class="col-md-4 col-lg-4" v-for="advert in adverts">
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
        <div v-else>
        	<blockquote>
        		We have no adverts to show you at the moment.<br>
        		Do stay in touch ;)
        	</blockquote>
        </div>

        <!-- Services -->
        <div class="row" v-if="services.length > 0">
            <div class="col-sm-12">
                <h4 class="text-primary">Related Services</h4>
            </div>
            <div class="col-md-4 col-lg-4" v-for="service in services">
                <div class="card">
                    <div class="card-heading">
                        <img :src="'/images/services/'+service.image_1" alt="..." width="100" class="img-thumbnail">
                        <span style="color: #000; font-weight: bold; font-size: 120%;">{{ service.title }}</span>
                    </div>
                    <div class="card-body" style="text-align: left; padding: 15px;">
                        <div v-html="service.description.substr(0, 200)"></div>

                        <a :href="'/service/'+service.id" target="__blank" class="btn btn-primary btn-fill">View Service</a>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <blockquote>
                We have no services to show you at the moment.
            </blockquote>
        </div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				adverts: [],
				advertURL: '/api/adverts/dashboard/6',

                services: [],
			}
		},
		methods: {
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
            loadServices() {
                axios.get('/api/buyers/services')
                .then(response => {
                    this.services = response.data.data
                })
            },
            escapeHTML(text) {
                var txt = document.createElement("textarea");
                txt.innerHTML = text;
                return txt.value;
            }
		},
		created() {
			this.loadAdverts()
            this.loadServices()
		},
	}
</script>