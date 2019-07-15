<template>
	<div>
    	<li class="p-b-10" v-for="category in categories">
            <a :href="openCategory(category.id)" class="stext-107 cl7 hov-cl1 trans-04">
                {{ category.name }}
            </a>
	    </li>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				categories: {},

				categoriesURL: '/api/category/limited',
			}
		},
		methods: {
			loadCategories() {
				axios.get(this.categoriesURL)
				.then((response) => {
					this.categories = response.data
				})
			},
			openCategory(id) {
				return '/category/'+id
			}
		},
		created() {
			this.loadCategories()
		}
	}
</script>
