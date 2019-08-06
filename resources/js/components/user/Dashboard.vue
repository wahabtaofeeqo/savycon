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
        		We have nothing to show you at the moment.<br>
        		Do stay in touch ;)
        	</blockquote>
        </div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				adverts: [],
				advertURL: '/api/adverts/dashboard/6'
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
			}
		},
		created() {
			this.loadAdverts()
		},
	}
</script>