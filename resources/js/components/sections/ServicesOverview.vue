<template>
  <div>
    <section class="bg0 p-t-50 p-b-140" id="search">
      <div class="container">
        <div class="p-b-10">
          <h3 class="ltext-103 cl5">
            Services Overvieww
            <div
              class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search"
            >
              <i
                class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"
              ></i>
              <i
                class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"
              ></i>
              Search
            </div>
          </h3>
        </div>

        <!-- Categories -->
        <div class="flex-w flex-sb-m p-b-52">
          <!-- Search -->
          <div class="dis-none panel-search w-full p-t-10 p-b-15">
            <div class="bor8 dis-flex p-l-15">
              <button
                class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04"
                @click="searchServices"
              >
                <i class="zmdi zmdi-search"></i>
              </button>

              <input
                class="mtext-107 cl2 size-114 plh2 p-r-15"
                type="text"
                v-model="search"
                @keyup="loadAllCategories"
                @keyup.enter="searchServices"
                name="search-service"
                placeholder="Search"
                list="available_categories"
              />
              <datalist id="available_categories">
                <option
                  :value="category.name"
                  v-for="category in allCategories"
                ></option>
              </datalist>

              <button
                class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04"
                @click="getMyLocation"
                title="Use my location"
              >
                <i class="zmdi zmdi-my-location"></i>
              </button>

              <input
                class="mtext-107 cl2 size-114 plh2 p-r-15"
                type="text"
                v-model="search_address"
                @keyup="loadAllLocations"
                @keyup.enter="searchServices"
                name="search_location"
                placeholder="Location"
                list="available_locations"
                id="search_location"
              />
              <datalist id="available_locations">
                <option
                  :value="location.name"
                  v-for="location in allLocations"
                ></option>
              </datalist>
            </div>
          </div>
        </div>

        <div class="alert alert-info" v-show="services.length < 1 && !loader">
          No service was found
          <mark>{{ search ? "for your search" : "in this category" }}</mark>
        </div>

        <div class="alert alert-warning" v-show="notfound === 1 && !loader">
          No service was found in the desired location, but you can check
          related services in other locations.
        </div>

        <div v-show="loader" class="text-center text-primary">
          Please be patient while we gather the information you are looking
          for...
        </div>

        <div v-show="!loader">
          <div class="row" v-show="services.length > 0">
            <div
              class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item"
              v-for="service in services"
            >
              <div class="block2">
                <div class="block2-pic hov-img0">
                  <img :src="getPhoto(service)" alt="IMG-SERVICE" />

                  <a
                    :href="openService(service.id)"
                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04"
                  >
                    View
                  </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                  <div class="block2-txt-child1 flex-col-l">
                    <small class="cl3 p-b-6">
                      <i class="fa fa-map-marker"></i> {{ service.city.name }},
                      {{ service.city.state.name }}
                    </small>
                    <span class="stext-105 cl3">
                      <a
                        :href="openService(service.id)"
                        class="stext-104 cl2 hov-cl1 trans-04 js-name-b2 p-b-6"
                        >{{ service.title }}</a
                      >
                      <br />
                      <small>
                        <a
                          :href="'/category/' + service.service.category.id"
                          class="cl4"
                        >
                          <img
                            :src="
                              '/images/tags/' +
                              service.service.category.image_tag
                            "
                            width="10"
                            height="10"
                            style="border-radius: 25%"
                          />
                          {{ service.service.category.name }}
                        </a>
                      </small>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div
          class="flex-c-m flex-w w-full p-t-45"
          v-show="pagination.next_page_url && !loader"
        >
          <button
            class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"
            @click="fetchPaginateServices(pagination.next_page_url)"
          >
            Shuffle
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loader: false,

      categories: [],

      services: [],
      pagination: {},

      servicesURL: "/api/services",
      categoriesURL: "/api/category",

      search: "",
      search_address: "",
      notfound: "",

      allCategories: [],
      allLocations: [],
      allCities: [],
    };
  },
  methods: {
    getPhoto(service) {
      var path = "/images/services/";

      if (service.image_1 === "unavailable.png") {
        path = "/images/tags/";

        name = service.service.category.image_tag;
      }

      return path + name;
    },
    loadCategories() {
      axios
        .get(this.categoriesURL)
        .then((response) => {
          this.categories = response.data;
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Oops!",
            text: "Category data cannot be collected at the moment",
          });
        });
    },
    categoryName(name) {
      return "." + name.toLowerCase().trim();
    },
    loadServices() {
      this.loader = true;

      axios
        .get(this.servicesURL)
        .then((response) => {
          this.services = response.data.data;

          this.makePagination(response.data);

          this.loader = false;
        })
        .catch((err) => {
          console.log(err);

          this.loader = false;
        });
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
    fetchPaginateServices(url) {
      this.url = url;
      this.loadServices();
    },
    categoriesLink() {
      return "/category";
    },
    openService(id) {
      return "/service/" + id;
    },
    searchServices() {
      const loader = this.$loading.show({
        container: this.$refs.serviceContainer,
      });

      this.loader = true;

      axios
        .get("/api/findService/" + this.search + "/" + this.search_address)
        .then((response) => {
          this.services = response.data.services.data;

          this.notfound = response.data.notfound;

          this.makePagination(response.data.services.data);
        })
        .catch(() => {
          console.log("Something went wrong");
        })
        .finally(() => {
          this.loader = false;

          loader.hide();
        });
    },
    loadAllCategories() {
      this.allCategories = [];

      setTimeout(() => {
        axios.get("/api/suggestCategory/" + this.search).then((response) => {
          this.allCategories = response.data;
        });
      }, 500);
    },
    loadAllLocations() {
      this.allLocations = [];

      setTimeout(() => {
        axios
          .get("/api/suggestLocation/" + this.search_address)
          .then((response) => {
            this.allLocations = response.data;
          });
      }, 500);
    },
    getMyLocation() {
      $("#search_location").attr("placeholder", "Fetching your location...");

      this.$parent.getMyLocation();

      setTimeout(() => {
        this.search_address = this.$parent.global_search_address;

        setTimeout(() => {
          if (this.search_address.length < 3)
            $("#search_location").attr(
              "placeholder",
              "We are having some delay. Try typing your location..."
            );
        }, 10000);
      }, 500);
    },
  },
  created() {
    Fire.$on("searching", () => {
      this.search = this.$parent.global_search;
      this.search_address = this.$parent.global_search_address;

      this.searchServices();

      window.location.hash = "search";
      $(".modal-search-header").removeClass("show-modal-search");
      $(".js-show-modal-search").css("opacity", "1");
    });
  },
  mounted() {
    this.loadCategories();
    this.loadServices();
  },
};
</script>

<style scoped>
.panel-search input {
  padding-left: 15px;
}
.panel-search input::placeholder {
  color: gray;
}
</style>