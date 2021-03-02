<template>
  <div>
    <p class="stext-102 cl3 m-t-10 font-weight-bold">{{ service.user.name }}</p>

    <div class="w-full m-t-15">
      <div class="header-cart-buttons flex-w w-full">
        <!-- :href="'mailto:' + service.user.email" -->
        <a :href="'mailto:' + service.user.email"
          class="flex-c-m stext-101 cl2 size-107 bg2 bor2 hov-btn1 p-lr-15 trans-04 m-b-10 m-r-8"
          >Email: {{service.user.email}}</a>

          <button class="btn btn-xs btn-primary d-none" style="margin-right: 10px;
    height: 32px;" @click="doCopyEmail()">Copy</button>
        <!-- :href="'tel:+234' + service.user.phone" -->

        <a :href="'tel:+234' + service.user.phone"
          class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 m-r-8"
          >Call: {{service.user.phone}}</a>

         <button class="btn btn-xs btn-primary d-none" style="margin-right: 10px;
    height: 32px;" @click="doCopyPhoneNumber()">Copy</button>

        <a
          :href="'https://api.whatsapp.com/send?phone=234' + service.user.phone" target="_blank"
          class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn2 p-lr-15 trans-04 m-b-10 m-r-8"
          >WhatsApp: {{service.user.phone}}</a
        >
      </div>
    </div>

    <!-- <div class="alert alert-primary" v-show="!visible">
			Apparently, you have to drop your phone number in order to see the vendor's contact details

			<form method="POST" @submit.prevent="savePhone" @keydown="form.onKeydown($event)">
				<div class="input-group">
					<input type="text" name="phonenumber" class="form-control" v-model="form.phonenumber" placeholder="Enter your phone number" required>
					<div class="input-group-btn">
						<input type="submit" name="submit" class="btn">
					</div>
				</div>
			</form>
		</div> -->
  </div>
</template>

<script>
export default {
  props: ["userservice"],
  data() {
    return {
      service: JSON.parse(this.userservice),
      visible: false,
      form: new Form({
        phonenumber: "",
      }),
    };
  },
  methods: {
    savePhone() {
      this.form
        .post("/api/phonenumber")
        .then(() => {
          this.visible = true;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    doCopyPhoneNumber: function () {
      this.$copyText("+234" + this.service.user.phone).then(
        function (e) {
          alert("Phone number Copied");
          console.log(e);
        },
        function (e) {
          alert("Can not copy");
          console.log(e);
        }
      );
    },
    doCopyEmail: function () {
      this.$copyText(this.service.user.email).then(
        function (e) {
          alert("Mail Copied");
          console.log(e);
        },
        function (e) {
          alert("Can not copy");
          console.log(e);
        }
      );
    },
  },
  created() {},
};
</script>
