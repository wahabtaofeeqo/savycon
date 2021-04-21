<template>
  <div>
    <div class="card">
      <div class="header">
        <h4 class="card-title">
          Sub Categories <span class="badge badge-primary">{{ services.length }}</span>
          <button class="pull-right btn btn-primary btn-fill" @click="openModal" v-show="!createmode">Add New</button>
          <button class="pull-right btn btn-default btn-fill" @click="openModal" v-show="createmode">Close Form</button>
          <div class="clearfix"></div>

          <p>
            <button v-show="mergeArray.length > 1" class="btn btn-info px-3" @click="mergeCategories">
              Merge Categories
            </button>
          </p>
        </h4>
        <p class="category">All Subcategoris</p>

        <alert-error :form="form"></alert-error>
        <alert-error :form="serviceForm"></alert-error>

        <form method="POST" v-show="createmode" id="form" @submit.prevent="editmode ? updateService() : createService()" @keydown="form.onKeydown($event)">
          <hr>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Name</div>
              <input type="text" name="name" v-model="form.name" class="form-control" :class="{ 'has-error':form.errors.has('name') }" placeholder="Name" autofocus="on" required>
              <div class="input-group-addon">Category</div>
              <div>
                <input type="text" name="category" v-model="form.category.name" class="form-control" @input="getCategories($event)" @keydown="onKey($event)" :disabled="editmode">
              </div>
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
        <div class="row">
          <div class="col-lg-12" id="showbox">
            <div class="alert alert-danger" v-show="services.length < 1">
              There are no sub categories yet
            </div>
            <div class="table-responsive table-full-width" v-show="services.length > 0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th>Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="category in services">
                    <td>
                      <img :src="'/images/tags/unavailable.png'" width="25" height="25" style="border-radius: 25%;">
                    </td>
                    <td>{{ category.name }}</td>
                    <td>
                      <button class="btn btn-sm btn-primary btn-fill" @click="editCategory(category)">Edit</button>
                      <button class="btn btn-sm btn-danger btn-fill" @click="deleteService(category.id)">Delete</button>
                    </td>
                    <td>
                      <input type="checkbox" :value="category.id" @change="updateMergeArray">
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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {

        createmode: false,
        editmode: false,

        selectedCategory: '',
        serviceMode: false,
        serviceCreateMode: false,
        serviceEditMode: false,

      	services: [],
      	pagination: {},
      	search: "",
      	file: "",

      	serviceForm: new Form({
			   name: '',
			   category: {
				   id: ''
			   },
		    }),

        form: new Form({
          id: '',
          name: '',
          category: {
            id: '',
            name: ''
          },
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

  openModal() {
        if (this.createmode) {
          this.createmode = false
        } else {
          this.createmode = true
        }

        this.editmode = false
        this.form.reset()
      },

    loadServices() {
      const loader = this.$loading.show();

      axios
        .get(this.url)
        .then((response) => {
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
        this.loadServices();
    },

    openServiceModal() {
        if (this.serviceCreateMode) {
          this.serviceCreateMode = false
        } else {
          this.serviceCreateMode = true
        }

        this.serviceEditMode = false
        this.serviceForm.reset()
      },


    editCategory(service) {
        $('#showbox')
          .addClass('col-lg-12')
          .removeClass('col-lg-6')
          .css('border', '0')

        this.serviceMode = false
        this.serviceCreateMode = false

        this.createmode = true
        this.editmode = true;
        
        this.form.id = service.id;
        this.form.name = service.name;
        this.form.category.id = service.category_id;
      },

    updateImageTag(e) {
                let file = e.target.files[0];
                var reader = new FileReader();

                if (file['size'] < 2097152 && (file['type'] == 'image/jpeg' || file['type'] == 'image/png' || file['type'] == 'image/jpg')) {
                    reader.onloadend = (file) => {
                        this.form.image_tag = reader.result;
                    }

                    reader.readAsDataURL(file);
                } else {
                    Swal.fire(
                        'Oops...',
                        'Please check the format (JPEG, JPG, PNG) and size (< 2MB) of the image.',
                        'error'
                    )
                }
            },

    async mergeCategories() {
        if (this.mergeArray.length > 1) {
          const str = this.mergeArray.join(",");
          const { value: formValues } = await Swal.fire({
            title: 'Multiple inputs',
            html:
              '<input id="swal-input1" class="swal2-input" placeholder="Parent">' +
              '<input id="swal-input2" class="swal2-input" placeholder="Category">',
            focusConfirm: false,
            preConfirm: () => {
              return [
                document.getElementById('swal-input1').value,
                document.getElementById('swal-input2').value
              ]
            }
          })

          if (formValues[0] != "" && formValues[1] != "") {
              const loader = this.$loading.show();
              const data = {services: str, parent: formValues[0], category: formValues[1]};

              axios.post('/api/mergeSubcategories', data)
              .then(response => {
                    Swal.fire({
                        type: 'success',
                        title: response.data.message
                    });
              
                    loader.hide();
                    this.loadServices();

              }).catch(err => {
                  loader.hide();
              })
          }
        }
      },

      updateService() {

        const loader = this.$loading.show();
        this.form.put('/api/sub-categories/' + this.form.id)
        .then((response) => {
          this.form.reset();
        })
        .catch(err => {
          Swal.fire({
                type: 'error',
                title: 'Operation not suceeded!'
              });
        })
        .finally(() => {
          loader.hide();
        })
      },

      createService() {
        const loader = this.$loading.show();
        this.form.post('/api/sub-categories')
        .then((response) => {
          this.form.reset();
        })
        .catch(err => {
          Swal.fire({
                type: 'error',
                title: 'Operation not suceeded!'
              });
        })
        .finally(() => {
          loader.hide();
        })
      },

      deleteService(id) {
        console.log(id);
      },

      getCategories(e) {
      if (this.form.category.name.length >= 2) {

        const url = '/api/categories/' + this.form.category.name;
          axios.get(url)
          .then(response => {
            this.autoComplete(e, response.data);
          })
          .catch(err => {
            console.log('Could not fetch Category ' + err)
          })
        }
        else {
          this.closeList();
        }
    },

    autoComplete: function(e, collection, sub = false) {

      this.closeList();
      if (collection.length == 0) return;

      const input = e.target;
      const wrapper = document.createElement("DIV");
      wrapper.setAttribute("class", "autocomplete-items");

      const component = this; // The Component ref
      e.target.parentNode.appendChild(wrapper);

                if (collection.length > 0) {
                    for (var i = 0; i < collection.length; i++) {

                        const val = this.form.city;
                        let current = collection[i];
                        const item = document.createElement("DIV");

                        // if (current.name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        //     b = "<strong>" + current.name.substr(0, val.length) + "</strong>";
                        //     b.innerHTML += current.name.substr(val.length);
                        //     b.innerHTML += "<input type='hidden' value='" + current.name + "'>";
                        // }


                        item.innerHTML = current.name;
                        item.innerHTML += "<input type='hidden' value='" + current.name + "'>";
                        item.innerHTML += "<input type='hidden' value='" + current.id + "'>";

                        item.addEventListener("click", function(e) {
                            component.closeList();
                            const value = this.getElementsByTagName("input")[0].value;
                            const id = this.getElementsByTagName("input")[1].value; // Id of the selected Item

                            component.form.category.name = value;
                            component.form.category.id = id;
                        });

                        wrapper.appendChild(item);
                    }
                }
    },

    setActive(elements) {
        this.removeActive(elements);

        if (this.focus >= elements.length) this.focus = 0;
        if (this.focus < 0) this.focus = (elements.length - 1);
                
        elements[this.focus].classList.add("autocomplete-active");
    },

    removeActive(elements) {
      for (var i = 0; i < elements.length; i++) {
        elements[i].classList.remove("autocomplete-active");
      }
    },

    closeList: function() {
                const x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    x[i].parentNode.removeChild(x[i]);
                }
    },

    onKey(e) {

                const wrapper = document.getElementsByClassName("autocomplete-items");
                if (wrapper && wrapper.length > 0) {
                    const elements = wrapper[0].getElementsByTagName('div');
                    if (e.keyCode == 40) {
                        this.focus++;
                        this.setActive(elements);
                    }

                    if (e.keyCode == 30) {
                        this.focus--;
                        this.setActive(elements);
                    }

                    if (e.keyCode == 13) {
                        if (this.focus > -1 && elements) {
                            e.preventDefault();
                            elements[this.focus].click();
                        }
                    }
                }
    },


  //   mergeCategories() {

  //   	const data = {
  //   		parent: this.serviceForm.name,
  //   		category: this.serviceForm.category.id,
  //   		services: this.mergeArray.join(",")
  //   	};
    	

		// if (this.mergeArray.length > 1) {
		// 	const loader = this.$loading.show();
	                
	 //        axios.post('/api/mergeSubcategories', data)
	 //        	.then(response => {
	                	
		//           	Swal.fire({
		// 				icon: 'success',
		// 				title: 'merged successfully'
		// 			});
						
		//             loader.hide();
		//             this.loadServices();
		//             this.serviceCreateMode = false;
	 //            }).catch(err => {
	 //            	Swal.fire({
		// 				icon: 'error',
		// 				title: 'Unable to merge Sub Categories'
		// 			});
	 //                loader.hide();
	 //            })

		// 	}
		// },
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

<style scoped>
.dropzone {
  height: 150px;
  width: 150px;
  background: lightgray;
  border-radius: 10px;
}
.dropzone-file {
  opacity: 0;
  position: absolute;
  height: 150px;
  width: 150px;
}
.dropzone-image {
  height: 150px;
  width: 150px;
  background: lightgray;
  border-radius: 10px;
}

.autocomplete {
      /*the container must be positioned relative:*/
      position: relative;
      display: inline-block;
}

    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      height: auto;
      max-height: 400px;
      overflow-y: auto;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }

    .autocomplete-items p {
        padding: 10px;
        text-align: center;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
      border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
      /*when hovering an item:*/
      background-color: #e9e9e9;
    }

  .autocomplete-active {
      /*when navigating through the items using the arrow keys:*/
      background-color: DodgerBlue !important;
      color: #ffffff;
  }
</style>