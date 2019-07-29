<template>
	<div>
		<h1 class="page-header">Contact Us Messages</h1>

		<div class="alert alert-danger" v-show="messages.length < 1">
			<p>There are no unresolved contact messages.</p>
		</div>

		<div v-show="messages.length > 0">
			<div class="row">
				<div class="col-md-4" v-for="(message, index) in messages">
					<div class="card">
						<div class="header">
							<h4 class="title">
								{{ index+1 }}
								<span class="pull-right">
									<button class="btn btn-sm btn-success btn-fill" @click="resolveMessage(message.id)">Resolve</button>
								</span>
								<div class="clearfix"></div>
							</h4>
							<p class="category">{{ message.created_at }}</p>
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
								<p>{{ message.phone }}</p>
							</div>
							<div class="form-group">
								<label>Message</label>
								<p style="white-space: pre-line;">{{ message.message }}</p>
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
				messages: [],

				url: '/api/contact/',
			}
		},
		methods: {
			loadMessages() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.messages = response.data

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
			resolveMessage(id) {
				const loader = this.$loading.show()

				axios.delete(this.url+id)
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