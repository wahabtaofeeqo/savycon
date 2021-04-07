<template>
  <section class="mt-4 mb-4">

    <div class="container">
      <h4 class="mb-4 text-center d-none">Service Page</h4>

      <div class="content">
        <alert-error :form="form"></alert-error>

        <form
          method="POST"
          @submit.prevent="createServicePage()"
          @keydown="form.onKeydown($event)" class="col-md-7 mx-auto">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="category">Category</label>
                    <!-- <select
                      class="form-control"
                      id="category"
                      v-model="form.category"
                      required @change="loadSubCategories()">
                      <option disabled value="">Choose a category</option>
                      <option
                        v-for="category in categories"
                        :key="category.id"
                        v-bind:value="category.name">
                        {{ category.name }}
                      </option>
                    </select> -->
                    <input type="text" class="form-control" id="category" placeholder="Enter Category" v-model="form.category" required @input="getCategories($event)" @keydown="onKey($event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="subcategory">Sub Category</label>
                    <!-- <select
                      class="form-control"
                      id="subcategory"
                      v-model="form.subcategory"
                      required>
                      <option disabled value="">Choose a Sub Category</option>
                      <option
                        v-for="sub in subcategories"
                        :key="sub.id"
                        v-bind:value="sub.name">
                        {{ sub.name }}
                      </option>
                    </select> -->
                    <input type="text" class="form-control" id="subcategory" placeholder="Enter Service" v-model="form.subcategory" required @input="getSubCategories($event)" @keydown="onKey($event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <input
                  v-model="form.content"
                  type="text"
                  name="content"
                  placeholder="Content"
                  class="form-control"
                  :class="{ 'has-error': form.errors.has('content') }"
                  id="content"
                  required
                />
                <has-error :form="form" field="content"></has-error>
              </div>
              <div class="form-group">
                <label for="content">Phone Number</label>
                <input
                  v-model="form.phonenumber"
                  type="text"
                  name="phonenumber"
                  placeholder="Phone number"
                  class="form-control"
                  :class="{ 'has-error': form.errors.has('phonenumber') }"
                  id="phonenumber"
                  required
                />
                <has-error :form="form" field="phonenumber"></has-error>
              </div>
              <div class="form-group">
                <label for="whatsapp">WhatsApp Number</label>
                <input
                  v-model="form.whatsapp"
                  type="text"
                  name="whatsapp"
                  placeholder="Whatsapp number"
                  class="form-control"
                  :class="{ 'has-error': form.errors.has('whatsapp') }"
                  id="whatsapp"
                  required
                />
                <has-error :form="form" field="whatsapp"></has-error>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea
                  class="form-control w-100"
                  rows="5"
                  v-model="form.description"
                  name="description"
                  placeholder="Describe your service, Add your Address, Phone Number and Whatsapp Number..."
                  :class="{ 'has-error': form.errors.has('description') }"
                  id="description"
                  required
                ></textarea>
                <has-error :form="form" field="description"></has-error>
              </div>

             <div class="form-check my-3">
                <input class="form-check-input" type="checkbox" required>
                <label class="form-check-label" for="checkbox">
                  Terms and Condition
                </label>
            </div>
            </div>
          </div>

          <button class="btn btn-primary btn-fill px-5" :disabled="form.busy" type="submit">
            Submit
          </button>

          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,

      form: new Form({
        content: "",
        description: "",
        category: "",
        subcategory: "",
        phonenumber: "",
        whatsapp: "",
      }),

      categories: {},
      subcategories: {},

      url: "/api/servicespage",

      categoryURL: "/api/category",

      focus: -1,

      selectedId: -1,
    };
  },
  methods: {
    loadCategories() {
      axios.get(this.categoryURL).then((response) => {
        this.categories = response.data;
      });
    },
    loadSubCategories() {
       const loader = this.$loading.show();
       axios.get('/api/category/services/' + this.form.category)
       .then((response) => {
        loader.hide();
        this.subcategories = response.data;
      });
    },

    getCategories(e) {
      if (this.form.category.length >= 2) {

        console.log(this.form.category);
        const url = '/api/categories/' + this.form.category;

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
                            component.selectedId = this.getElementsByTagName("input")[1].value; // Id of the selected Item

                            if (sub) {
                              component.form.subcategory = value;
                            }
                            else {
                              component.form.category = value;
                            }
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

    getSubCategories(e) {
      if (this.form.category.length >= 2) {

        console.log(this.form.subcategory);
        const url = '/api/subcategories/' + this.form.subcategory + '/' + this.selectedId;

          axios.get(url)
          .then(response => {
            this.autoComplete(e, response.data, true);
          })
          .catch(err => {
            console.log('Could not fetch Category ' + err)
          })
        }
        else {
          this.closeList();
        }
    },

    createServicePage() {
      const loader = this.$loading.show();

      console.log(this.form);
      this.form
        .post(this.url)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Request submitted successfully.",
            text: "Thank You! We will get back to you.",
          });

          this.form.reset();

          // setTimeout(() => {
          //   window.location.reload();
          // }, 2000);
        })
        .catch((e) => {
          
          Swal.fire({
            title: "Oops!",
            text: "request was not sent for some reason",
            icon: "error",
          });

          //loader.hide();
        }).
        finally(() => {
          loader.hide();
        });
    },
  },
  created() {
    this.loadCategories();
  },
  mounted() {},
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