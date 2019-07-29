<template>
	<div>
		<div class="card">
			<div class="header">
				<h4 class="card-title">Unfound Searches <span class="badge badge-primary">{{ searches.length }}</span></h4>
				<p class="category">What users are looking for, but cannot find</p>
			</div>
			<div class="content">
				<div class="alert alert-danger" v-show="searches.length < 1">
					There are no unfound searches yet
				</div>
				<div class="table-responsive table-full-width" v-show="searches.length > 0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Text</th>
								<th>Address</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(search, index) in searches">
								<td>{{ index+1 }}</td>
								<td>{{ search.text }}</td>
								<td>{{ search.address }}</td>
								<td>
									<button class="btn btn-sm btn-primary btn-fill" @click="removeSearch(search.id)">Remove</button>
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
				searches: [],

				url: '/api/search/',
			}
		},
		methods: {
			loadSearches() {
				const loader = this.$loading.show();

				axios.get(this.url)
				.then((response) => {
					this.searches = response.data

					loader.hide();
				})
				.catch(() => {
					Swal.fire({
						type: 'error',
						title: 'Oops!',
						text: 'We could not load the unfound searches at the moment'
					})

					loader.hide();
				})
			},
			removeSearch(id) {
				const loader = this.$loading.show()

				axios.delete(this.url+id)
				.then(() => {
					Fire.$emit('refreshSearches')

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
			this.loadSearches()	

			Fire.$on('refreshSearches', () => {
				this.loadSearches()
			})		
		},
	}
</script>