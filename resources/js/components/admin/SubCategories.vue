<template>
  <div>
    <div class="card">
      <div class="header">
        <h4 class="card-title">
          Sub Categories
          <span class="badge badge-primary">{{ pagination.total_items }}</span>


          <div class="pull-right" v-show="mergeArray.length > 1">
            <button class="btn btn-info px-3" @click="editService">
				Merge Sub Categories
			</button>
          </div>
        </h4>

        <p class="category">All Sub Categories</p>
        <form method="POST" v-show="serviceCreateMode" id="serviceForm" @submit.prevent="mergeCategories()">
			<hr>
				<div class="form-group">
					<div class="input-group">
						<input type="text" name="name" v-model="serviceForm.name" class="form-control" :class="{ 'has-error':serviceForm.errors.has('name') }" placeholder="Name" autofocus="on" required>
						<div class="input-group-addon">-</div>
						<select class="form-control" name="category_id" v-model="serviceForm.category.id" required>
							<option disabled value="">Select a category</option>
							<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
						</select>
						<div class="input-group-btn">
							<button type="submit" :disabled="serviceForm.busy" class="btn btn-primary btn-fill">
								Merge
							</button>
	
						</div>
					</div>
					<has-error :form="serviceForm" field="name"></has-error>
				</div>
			<hr>
		</form>
      </div>
      <div class="content">
        <div class="alert alert-danger" v-show="services.length < 1">
          There are no Sub Categories yet
        </div>
        <div
          class="table-responsive table-full-width"
          v-show="services.length > 0">
          <table class="table">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(service, index) in services"
                :key="service.id"
                :class="{
                  'bg-info': service.featured == 1,
                  'bg-danger': service.active == 0,
                }">
                <td>{{ index + 1 }}</td>
                <td>{{ service.name }}</td>
                <td>
					<input type="checkbox" :value="service.id" @change="updateMergeArray">
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
          :click-handler="fetchPaginateCategoriesWithIndex"
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
  data() {
    return {
      	services: [],
      	pagination: {},
      	search: "",
      	file: "",

      	serviceForm: new Form({
			name: '',
			category: {
				id: ''
			}
		}),

      	
      	categories: [],
      	mergeArray: [],

      	serviceMode: false,
		serviceCreateMode: false,
		serviceEditMode: false,

		url: "/api/sub-category",
      	categoryURL: '/api/categories',
    };
  },
  methods: {

  	editService() {
		this.serviceCreateMode = true
		this.serviceEditMode = true
	},

  	updateMergeArray(event) {

		const id = event.target.getAttribute('value');
		var found = false;

		if (this.mergeArray.length > 0) {
			for (var i = 0; i < this.mergeArray.length; i++) {
				if (this.mergeArray[i] == id) {
					found = true;

					//Delete the element
					this.mergeArray.splice(i, 1);
					break;
				}
			}
		}

		if (!found) {
			this.mergeArray.push(id);
		}
	},

    loadServices() {
      const loader = this.$loading.show();

      axios
        .get(this.url)
        .then((response) => {
          this.loadCategories();
          this.services = response.data.data;
          this.makePagination(response.data);
          loader.hide();
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Oops!",
            text: "We could not load your services at the moment",
          });

          loader.hide();
        });
    },

    loadCategories() {
		
		axios.get(this.categoryURL)
			.then((response) => {
				this.categories = response.data.data
			})
			.catch(() => {
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'We could not retrieve the categories'
			});
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

    fetchPaginateCategoriesWithIndex(pageno) {
        this.url = '/api/sub-category?page='+pageno;
        //console.log(pageno);
        this.loadServices();
    },

    mergeCategories() {

    	const data = {
    		parent: this.serviceForm.name,
    		category: this.serviceForm.category.id,
    		services: this.mergeArray.join(",")
    	};
    	

		if (this.mergeArray.length > 1) {
			const loader = this.$loading.show();
	                
	        axios.post('/api/mergeSubcategories', data)
	        	.then(response => {
	                	
		          	Swal.fire({
						icon: 'success',
						title: 'merged successfully'
					});
						
		            loader.hide();
		            this.loadServices();
		            this.serviceCreateMode = false;
	            }).catch(err => {
	            	Swal.fire({
						icon: 'error',
						title: 'Unable to merge Sub Categories'
					});
	                loader.hide();
	            })

			}
		},
  	},

  	created() {
    	this.loadServices();
    	Fire.$on("refreshServices", () => {
      		this.loadServices();
    	});
  	},
  	mounted() {}
}
</script>