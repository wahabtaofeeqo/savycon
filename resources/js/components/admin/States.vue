<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">
					States <span class="badge badge-primary">{{ states.length }}</span>
					<button class="pull-right btn btn-primary btn-fill" @click="openModal" v-show="!createmode">Add New</button>
					<button class="pull-right btn btn-default btn-fill" @click="openModal" v-show="createmode">Close Form</button>
					<div class="clearfix"></div>
				</h4>
				<p class="category">All states</p>

				<alert-error :form="form"></alert-error>

				<form method="POST" v-show="createmode" id="form" @submit.prevent="editmode ? updateState() : createState()" @keydown="form.onKeydown($event)">
					<hr>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="name" v-model="form.name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" placeholder="Name" required>
							<div class="input-group-btn">
								<button type="submit" :disabled="form.busy" class="btn btn-primary btn-fill" v-show="!editmode">Create</button>
								<button type="submit" :disabled="form.busy" class="btn btn-success btn-fill" v-show="editmode">Update</button>
							</div>
						</div>
						<has-error :form="form" field="name"></has-error>
					</div>
					<hr>
				</form>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="states.length < 1">
					There are no states yet
				</div>
				<div class="table-responsive table-full-width" v-show="states.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Cities count</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="state in states">
								<td>{{ state.name }}</td>
								<td>{{ state.cities_count }}</td>
								<td>
									<button class="btn btn-sm btn-primary btn-fill" @click="editState(state)">Edit</button>
									<button class="btn btn-sm btn-danger btn-fill" @click="deleteState(state.id)">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				createmode: false,
				editmode: false,

				states: [],
				pagination: {},

				form: new Form({
					id: '',
					name: '',
				}),

				url: '/api/state',
			}
		},
		methods: {
			loadStates() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.states = response.data.data

					this.makePagination(response.data)

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load your states at the moment'
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
                    total_pages: data.total,
                };

                this.pagination = pagination;
            }, 
            fetchPaginateStates(url) {
                this.url = url;
                this.loadStates();
            },
			deleteState(id) {
				Swal.fire({
					title: 'Are you sure?',
					text: 'This action cannot be reverted',
					type: 'warning',
					showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
				})
				.then((result) => {
					if (result.value) {
						const loader = this.$loading.show();

						axios.delete(this.url+'/'+id)
						.then(() => {
							Swal.fire({
								type: 'success',
								title: 'State was deleted successfully'
							})

							loader.hide()
							Fire.$emit('refreshStates')
						})
						.catch(() => {
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								html: 'We could not delete the state.<br>Please try again later'
							})

							loader.hide()
						})
					}
				})
			},
			editState(state) {
				this.createmode = true
				this.editmode = true
				this.form.fill(state)
			},
			openModal() {
				if (this.createmode) {
					this.createmode = false
				} else {
					this.createmode = true
				}

				this.editmode = false
				this.form.reset()
			},
			createState() {
				const loader = this.$loading.show()

				this.form.post(this.url)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'State was successfully created',
					})

					this.createmode = false
					this.form.reset()

					Fire.$emit('refreshStates')

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					loader.hide()
				})
			},
			updateState() {
				const loader = this.$loading.show()

				this.form.put(this.url+'/'+this.form.id)
				.then(() => {
					Swal.fire({
						type: 'success',
						title: 'State was successfully updated',
					})

					this.createmode = false
					this.form.reset()

					Fire.$emit('refreshStates')

					loader.hide()
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong'
					})

					loader.hide()
				})
			},
		},
		created() {
			this.loadStates()

			Fire.$on('refreshStates', () => {
				this.loadStates()
			})
		},
		mounted() {

		}
	}
</script>