<template>
	<div>
		<div class="card">
			<div class="alert alert-danger" v-show="payments.length < 1">
				No record found
			</div>
			<div class="content">
				<div class="table-responsive table-full-width" v-show="payments.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Type</th>
								<th>User</th>
								<th>Amount</th>
								<th>Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(payment, index) in payments">
								<td>{{ index + 1 }}</td>
								<td>{{ payment.type }}</td>
								<td>{{ payment.user.name }}</td>
								<td>{{ payment.amount }}</td>
								<td>{{ payment.created_at }}</td>
								<td>
									<button class="btn btn-sm btn-danger btn-fill" @click="deletePayment(payment.id)">
										Delete
									</button>
									<a :href="setPath(payment)" class="btn  btn-sm btn-info" target="_blank">View Invoice</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Pagination -->
				<paginate
					:page-count="pagination.last_page || 0"
					:page-range="5"
					:margin-pages="5"
					:click-handler="fetchPaginateWithIndex"
					:prev-text="'Prev'"
					:next-text="'Next'"
					:container-class="'pagination'"
					:page-class="'page-item'">
				</paginate>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

		methods: {
			loadPayments() {

				const loader = this.$loading.show()

				axios.get(this.url)
				.then((response) => {
					console.log(response);
					this.payments = response.data.data;
					this.makePagination(response.data);
				})
				.catch(() => {
					Swal.fire({
						icon: 'warning',
						title: 'We could not load the cities...'
					})
				})
				.finally(() => {
					loader.hide();
				})
			},

			setPath(payment) {
				return "/invoice/" + payment.id;
			},

			deletePayment(id) {
				Swal.fire({
					title: 'Are you sure?',
					text: 'This action cannot be reverted',
					icon: 'warning',
					showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
				})
				.then(result => {
					if (result.isConfirmed) {
						axios.delete('/api/categories/'+id)
						.then(() => {
							Swal.fire({
								icon: 'success',
								title: 'Deleted successfully'
							})
							Fire.$emit('refreshCategories')
						})
						.catch(() => {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								html: 'We could not delete the category.<br>Please try again later'
							})
						})
						.finally(() => {
							loader.hide();
						})
					}
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

			fetchPaginateWithIndex(pageno) {
                this.url = '/api/payments?page='+pageno;
                this.loadPayments();
            },
		},

		data() {
			return {
				payments: [],

				url: '/api/payments',

				pagination: {}
			}
		},

		created() {
			this.loadPayments();
		},

		mounted() {},
	}
</script>