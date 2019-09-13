<template>
	<div>
		<h1 class="page-header">
			Unresolved Messages for Services
			<span class="badge badge-primary">{{ pagination.total_items }}</span>
		</h1>

		<div class="alert alert-danger" v-show="messages.length < 1">
			<p>There are no unresolved messages.</p>
		</div>

		<div v-show="messages.length > 0">
			<div class="row">
				<div class="col-md-4" v-for="(message, index) in messages">
					<div class="card">
						<div class="header">
							<h4 class="title">
								{{ message.id }}
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

				<div class="col-md-12">
					<paginate
						:page-count="pagination.last_page || 0"
						:page-range="5"
						:margin-pages="5"
						:click-handler="fetchPaginateMessagesWithIndex"
						:prev-text="'Prev'"
						:next-text="'Next'"
						:container-class="'pagination'"
						:page-class="'page-item'">
					</paginate>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				messages: [],
				pagination: {},

				url: '/api/messages/',
			}
		},
		methods: {
			loadMessages() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.messages = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load the messages at the moment'
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
            fetchPaginateMessagesWithIndex(pageno) {
                this.url = '/api/messages?page='+pageno;
                this.loadMessages();
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
			}
		},
		created() {
			this.loadMessages()

			Fire.$on('refreshMessages', () => {
				this.loadMessages()
			})			
		},
	}
</script>