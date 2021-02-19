<template>
	<div>
		<!-- Reviews -->
		<div v-if="ratings.length > 0">
			<div class="flex-w flex-t p-b-30" v-for="rating in ratings">
				<div class="size-207">
					<div class="flex-w flex-sb-m p-b-10">
						<span class="mtext-107 cl2 p-r-20">
							{{ rating.user.name }}
						</span>

						<span class="fs-18 cl11">
							<i class="zmdi zmdi-star" v-for="rate in rating.stars"></i>
						</span>
					</div>

					<p class="stext-102 cl6">
						{{ rating.comment }}
					</p>
				</div>
			</div>
		</div>
		<div class="alert alert-info" v-else>
			There are no reviews at the moment
		</div>

		<!-- New review -->
		<div v-if="can_comment == 'yes'">
			<div v-if="can_user_review == 'yes'">
		    	<form class="w-full" @submit.prevent="saveReview()" @keydown="form.onKeydown($event)" v-if="can_really_comment == 'yes' || ratings.length < 1">
					<hr>
					<h5 class="mtext-108 cl2 p-b-7">
						Add a review
					</h5>

					<p class="stext-102 cl6">
						Your email address will not be published.
					</p>

					<div class="flex-w flex-m p-t-50 p-b-23">
						<span class="stext-102 cl3 m-r-16">
							Your Rating
						</span>

						<span class="wrap-rating fs-18 cl11 pointer">
							<i class="item-rating pointer zmdi zmdi-star-outline" @click="form.stars = 1"></i>
							<i class="item-rating pointer zmdi zmdi-star-outline" @click="form.stars = 2"></i>
							<i class="item-rating pointer zmdi zmdi-star-outline" @click="form.stars = 3"></i>
							<i class="item-rating pointer zmdi zmdi-star-outline" @click="form.stars = 4"></i>
							<i class="item-rating pointer zmdi zmdi-star-outline" @click="form.stars = 5"></i>
						</span>
						<has-error :form="form" field="stars"></has-error>
					</div>

					<div class="row p-b-25">
						<div class="col-12 p-b-5">
							<label class="stext-102 cl3" for="review">Your review</label>
							<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review" v-model="form.comment" required></textarea>
							<has-error :form="form" field="comment"></has-error>
						</div>
					</div>

					<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" :disabled="form.busy">
						Submit
					</button>
				</form>
				<div class="alert alert-info" v-else>
					<p>You cannot comment on this service because you have dropped a comment already.<br>Thanks though ;)</p>
				</div>
			</div>
			<div class="alert alert-success" v-else>
				<p>You cannot review your own service</p>
			</div>
		</div>
		<div class="alert alert-danger" v-else>
			<p>You cannot comment on this service if you are not a user</p>
			<button type="button" class="js-show-cart flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn2 p-lr-15 trans-04">Sign In</button>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'can_comment',
			'can_user_review',
			'can_really_comment',
			'service_id'
		],
		data() {
			return {				
				form: new Form({
					stars: 0,
					comment: '',
					service_id: this.service_id
				}),

				ratings: [],
				pagination: {},
				url: '/api/rating/',
			}
		},
		methods: {
			loadRatings() {
				const loader = this.$loading.show({
					container: this.$refs.reviewContainer,
				})

				axios.get(this.url+this.service_id)
				.then((response) => {
					this.ratings = response.data.data

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
            fetchPaginateRatings(url) {
                this.url = url;
                this.loadRatings();
            },
			saveReview() {
				const loader = this.$loading.show({
					container: this.$refs.reviewContainer,
				})

				this.form.post('/api/rating')
				.then(() => {
					loader.hide()

					window.location.reload()
				})
				.catch(() => {
					loader.hide()

					Swal.fire({
						type: 'error',
						title: 'Something went wrong!',
						text: 'Please try again later'
					})
				})
			},
		},
		mounted() {
			this.loadRatings()
		}
	}
</script>
