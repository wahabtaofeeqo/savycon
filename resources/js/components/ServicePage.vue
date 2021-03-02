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
                    <select
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
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="subcategory">Sub Category</label>
                    <select
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
                    </select>
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
                  placeholder="Describe your service, Add your Address..."
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

          <button
            class="btn btn-primary btn-fill"
            :disabled="form.busy"
            type="submit"
          >
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
    createServicePage() {
      const loader = this.$loading.show();

      console.log(this.form);
      this.form
        .post(this.url)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Request submitted successfully.",
            text: "We will reload the page now...",
          });

          this.form.reset();

          setTimeout(() => {
            window.location.reload();
          }, 2000);
        })
        .catch((e) => {
          
          Swal.fire({
            title: "Oops!",
            text: "request was not sent for some reason",
            icon: "error",
          });

          loader.hide();
        });
    },
  },
  created() {
    this.loadCategories();
  },
  mounted() {},
};
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
</style>
