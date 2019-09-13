<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Subscribers <span class="badge badge-primary">{{ pagination.total_items }}</span></h4>
				<p class="category">All your email subscriptions</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="subscribers.length < 1">
					There are no subscribers yet
				</div>
				<div class="table-responsive table-full-width" v-show="subscribers.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(user, index) in subscribers">
								<td>{{ index+1 }}</td>
								<td>{{ user.email }}</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Pagination -->
				<div class="paginator btn-group">
					<button class="btn btn-fill btn-primary" @click="fetchPaginateSubscribers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" v-show="pagination.prev_page_url">
						<i class="fa fa-arrow-left"></i> Prev
					</button>

					<button class="btn btn-fill btn-default" @click="fetchPaginateSubscribersWithIndex(pageno)" v-for="pageno in pagination.last_page" :disabled="pageno == pagination.current_page" :key="pageno" v-show="pagination.last_page > 1">
						{{ pageno }}
					</button>

					<button class="btn btn-fill btn-primary pull-right" @click="fetchPaginateSubscribers(pagination.next_page_url)" :disabled="!pagination.next_page_url" v-show="pagination.next_page_url">
						Next <i class="fa fa-arrow-right"></i>
					</button>

					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				subscribers: [],
				pagination: {},

				url: '/api/subscribers/',
			}
		},
		methods: {
			loadSubscribers() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.subscribers = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load the subscribers at the moment'
					})

					loader.hide();
				})
			},
			makePagination(data) {
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    total_items: data.total,
                };

                this.pagination = pagination;
            }, 
            fetchPaginateSubscribers(url) {
                this.url = url;
                this.loadSubscribers();
            },
            fetchPaginateSubscribersWithIndex(pageno) {
                this.url = '/api/subscribers?page='+pageno;
                this.loadSubscribers();
            },
		},
		created() {
			this.loadSubscribers();
		},
	}
</script>