<template>
  <div>

    <div style="padding: 10px">
      <a href="servicelink" class="btn btn-primary px-5">Generate Link</a>
    </div>

    <h1 class="page-header h4">
      Service Page Requests
      <span class="badge badge-primary">{{ pagination.total_items }}</span>
    </h1>

    <div class="alert alert-danger" v-show="messages.length < 1">
      <p>There are no unresolved service page messages.</p>
    </div>

    <div v-show="messages.length > 0">
      <div class="row">
        <div class="col-md-4" v-for="(message, index) in messages" :key="message.id">
          <div class="card">
            <div class="header">
              <h4 class="title">
                {{ index + 1 }}
                <span class="pull-right">
                  <!-- <button
                    class="btn btn-sm btn-success btn-fill"
                    @click="resolveMessage(message.id)"
                  >
                    Resolve
                  </button> -->
                </span>
                <div class="clearfix"></div>
              </h4>
              <p class="category">{{ message.created_at }}</p>
            </div>
            <div class="content">
              <div class="form-group">
                <label>Category</label>
                <p>{{ message.category }}</p>
              </div>
              <div class="form-group">
                <label>Content</label>
                <p>{{ message.content }}</p>
              </div>
              <div class="form-group">
                <label>WhatsApp</label>
                <p>{{ message.whatsapp }}</p>
              </div>
              <div class="form-group">
                <label>Phone number</label>
                <p>{{ message.phonenumber }}</p>
              </div>
              <div class="form-group">
                <label>Description</label>
                <p style="white-space: pre-line">{{ message.description }}</p>
              </div>
              <button class="btn btn-sm btn-danger" @click="deleteService(message.id)">Delete</button>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <paginate
            :page-count="pagination.last_page || 0"
            :page-range="5"
            :margin-pages="5"
            :click-handler="fetchPaginateContactWithIndex"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'"
            :page-class="'page-item'"
          >
          </paginate>
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
      pagination: {},

      url: "/api/servicepagerequests/",
    };
  },
  methods: {
    loadMessages() {
      const loader = this.$loading.show();

      axios
        .get(this.url)
        .then((response) => {
            console.warn(response.data.data);
          this.messages = response.data.data;

          this.makePagination(response.data);

          loader.hide();
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Oops!",
            text: "We could not load the messages at the moment",
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
    fetchPaginateContactWithIndex(pageno) {
      this.url = "/api/contact?page=" + pageno;
      this.loadMessages();
    },
    // resolveMessage(id) {
    //   const loader = this.$loading.show();

    //   axios
    //     .delete("/api/contact/" + id)
    //     .then(() => {
    //       Swal.fire({
    //         type: "success",
    //         title: "Message was resolved successfully",
    //       });

    //       Fire.$emit("refreshMessages");

    //       loader.hide();
    //     })
    //     .catch(() => {
    //       Swal.fire({
    //         type: "error",
    //         title: "Message could not be resolved",
    //       });

    //       loader.hide();
    //     });
    // },
    deleteService(id) {
      Swal.fire({
          title: 'Delete this?',
          icon: 'info',
          showCloseButton: true,
          showCancelButton: true,
          confirmButtonText: 'Yes!',
          cancelButtonText: 'No!',
          footer: '<small class="text-danger">Can not be recovered!</small>'
      }).then(response => {
        if (response.isConfirmed) {

            const loader = this.$loading.show();

            axios.delete('/api/deleteService/' + id)
            .then(response => {
              loader.hide();
              Swal.fire({
                icon: "success",
                title: "Deleted successfully",
              });
            })
            .catch(err => {
              loader.hide();
              Swal.fire({
                icon: "error",
                title: "Could not be deleted!",
              });
            });
        }
      })

     
    }
  },
  created() {
    this.loadMessages();

    // Fire.$on("refreshMessages", () => {
    //   this.loadMessages();
    // });
  },
};
</script>