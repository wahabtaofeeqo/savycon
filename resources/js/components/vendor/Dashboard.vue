<template>
	<div>
		<div class="alert alert-info" v-show="services.length < 1">
        	<p>You have not registered any service</p>
        </div>

        <div class="row" v-show="services.length > 0">
        	<div class="col-sm-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Services</h4>
                        <p class="category">Here is a list of all your services</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th></th>
                            	<th>Name</th>
                            	<th>Price (₦)</th>
                            	<th>Description</th>
                            	<th>Views <i class="fa fa-heart"></i></th>
                            </thead>
                            <tbody>
                                <tr v-for="service in services">
                                	<td>
                                		<a :href="viewService(service.id)" class="btn btn-sm btn-primary">View</a>
                                	</td>
                                	<td>{{ service.title }}</td>
                                	<td>{{ service.price }}</td>
                                	<td>{{ service.description }}</td>
                                	<td></td>
                                </tr>
                            </tbody>
                        </table>
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
				services: {},
				pagination: [],
				url: '/api/service',
			}
		},
		methods: {
			getServices() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.services = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					loader.hide();
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
                this.getServices();
            },
            viewService(id) {
            	return '/services/'+id;
            },
		},
		created() {
			this.getServices();
		},
		mounted() {

		}
	}
</script>