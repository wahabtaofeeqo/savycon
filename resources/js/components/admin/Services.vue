<template>
  <div>

    <div class="bg-info" style="background: red;">
      <div class="col-md-12 mb-4">
         <input type="file" name="file" v-on:change="prepareFile" class="mb-4">
      </div>
      <div class="col-md-12">
        <button class="btn btn-sm btn-danger" @click="uploadFile">Upload New Service</button>
      </div>
    </div>

    <div class="card">
      <div class="header">
        <h4 class="card-title">
          Services
          <span class="badge badge-primary">{{ pagination.total_items }}</span>

          <div class="pull-right">
            <input
              type="text"
              name="search"
              class="form-control"
              v-model="search"
              placeholder="Search by title..."
              @input="searchService"
              @keyup.enter="searchService"
            />
          </div>
        </h4>
        <p class="category">All your services</p>
      </div>
      <div class="content">
        <div class="alert alert-danger" v-show="services.length < 1">
          There are no services yet
        </div>
        <div
          class="table-responsive table-full-width"
          v-show="services.length > 0">
          <table class="table">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Price (₦)</th>
                <th>Location</th>
                <th>Category</th>
                <th>Owner</th>
                <th>Views</th>
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
                }"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ service.title }}</td>
                <td>{{ service.price }}</td>
                <td>{{ service.city.name }}, {{ service.city.state.name }}</td>
                <td>{{ service.service.category.name }}</td>
                <td>{{ service.user.name }}</td>
                <td>{{ service.views }}</td>
                <td>
                  <a
                    :href="viewService(service.id)"
                    class="btn btn-sm btn-success btn-fill"
                    target="__blank"
                    >View</a
                  >
                  <router-link
                    :to="{
                      name: 'AdminNewService',
                      params: { id: service.id },
                    }"
                    class="btn btn-sm btn-info btn-fill"
                    >Edit</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger btn-fill"
                    @click="deleteService(service.id)"
                  >
                    Delete
                  </button>
                  <hr style="margin: 5px" />

                  <button
                    class="btn btn-sm btn-primary btn-fill"
                    @click="featureService(service.id)"
                    v-if="service.featured == 0"
                  >
                    Feature
                  </button>
                  <button
                    class="btn btn-sm btn-warning btn-fill"
                    @click="featureService(service.id)"
                    v-else
                  >
                    Unfeature
                  </button>

                  <button
                    class="btn btn-sm btn-danger btn-fill"
                    @click="banService(service.id)"
                    v-if="service.active == 1"
                  >
                    Ban
                  </button>
                  <button
                    class="btn btn-sm btn-primary btn-fill"
                    @click="banService(service.id)"
                    v-else
                  >
                    Unban
                  </button>
                  <button class="btn btn-sm btn-primary btn-fill">
                    <ShareNetwork
                      network="twitter"
                      :url="'https://savycon.com'"
                      :title="`Business Name - ${
                        service.title
                      } ${'\n'} Category - ${service.service.category.name} ${'\n'} Address - ${
                        service.address
                      } ${'\n'} Phone Number - +234${service.user.phone}`"
                      
                      :hashtags="'Savycon'"
                      :twitterUser="'Savycon'"
                    >
                      <span>Twitter</span>
                    </ShareNetwork>
                  </button>
                  <button class="btn btn-sm btn-primary btn-fill">
                    <ShareNetwork
                      network="facebook"
                      :url="'https://savycon.com'"
                      :title="`Business Name - ${
                        service.title
                      } ${'\n'} Category - ${service.service.category.name} ${'\n'} Address - ${
                        service.address
                      } ${'\n'} Phone Number - +234${service.user.phone}`"
                      :quote="'SavyCon'"
                    >
                      <span>Facebook</span>
                    </ShareNetwork>
                  </button>
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
          :click-handler="fetchPaginateServicesWithIndex"
          :prev-text="'Prev'"
          :next-text="'Next'"
          :container-class="'pagination'"
          :page-class="'page-item'"
        >
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

      url: "/api/userService/",
    };
  },
  methods: {

    prepareFile(e) {

      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) 
        return;
      this.file = files[0];
    },

    uploadFile() {
      const loader = this.$loading.show();

      const form = new FormData();
      form.append('file', this.file);

      axios.post('/api/uploadService', form, {headers: {'content-type': 'multipart/form-data'}})
      .then(response => {
        loader.hide();
        Swal.fire({
            type: "success",
            title: "Service was uploaded successfully",
        });
      })
      .catch(e => {
        Swal.fire({
            type: "error",
            title: "Oops!",
            text: "Services could not be uploaded!",
          });

        loader.hide();
      })
    },

    loadServices() {
      const loader = this.$loading.show();

      axios
        .get(this.url)
        .then((response) => {
          console.log(response.data.data);
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
    fetchPaginateServicesWithIndex(pageno) {
      this.url = "/api/userService?page=" + pageno;
      this.loadServices();
    },
    searchService() {
      setTimeout(() => {
        axios
          .get("/api/findAdminService/" + this.search)
          .then((response) => {
            this.services = response.data.data;

            this.makePagination(response.data);
          })
          .catch(() => {
            Toast.fire({
              type: "error",
              title: "Search does not exist",
            });
          });
      }, 500);
    },
    deleteService(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be reverted",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          const loader = this.$loading.show();

          axios
            .delete("/api/userService/" + id)
            .then(() => {
              Swal.fire({
                type: "success",
                title: "Service was deleted successfully",
              });

              loader.hide();
              Fire.$emit("refreshServices");
            })
            .catch(() => {
              Swal.fire({
                type: "error",
                title: "Oops...",
                html:
                  "We could not delete the service.<br>Please try again later",
              });

              loader.hide();
            });
        }
      });
    },
    viewService(id) {
      return "/service/" + id;
    },
    featureService(id) {
      const loader = this.$loading.show();

      axios
        .get("/api/feature/service/" + id)
        .then(() => {
          loader.hide();

          Fire.$emit("refreshServices");
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Oops...",
            text: "We could not feature the service at the moment",
          });

          loader.hide();
        });
    },
    banService(id) {
      const loader = this.$loading.show();

      axios
        .get("/api/ban/service/" + id)
        .then(() => {
          loader.hide();

          Fire.$emit("refreshServices");
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Oops...",
            text: "We could not ban the service at the moment",
          });

          loader.hide();
        });
    },
  },
  created() {
    this.loadServices();

    Fire.$on("refreshServices", () => {
      this.loadServices();
    });
  },
  mounted() {},
};
</script>