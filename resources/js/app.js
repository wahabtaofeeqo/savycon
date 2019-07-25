
require('./bootstrap');

window.Vue = require('vue');

// Form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Axios
import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

// Sweet Alert
import Swal from 'sweetalert2';
window.Swal = Swal;
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});
window.Toast = Toast;

// Overlay loader
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.use(Loading, {
	loader: 'bars',
});

// event emitter
window.Fire = new Vue();

// Components
import VendorDashboard from './components/vendor/Dashboard.vue';
import VendorProfile from './components/Profile.vue';
import VendorServices from './components/vendor/Services.vue';
import VendorNewService from './components/vendor/NewService.vue';
import BuyerRequests from './components/vendor/BuyerRequests.vue';

import UserDashboard from './components/user/Dashboard.vue';
import UserRequests from './components/user/UserRequests.vue';
import PostRequest from './components/user/PostRequest.vue';
import UserProfile from './components/Profile.vue';

import ErrorPage from './components/404.vue';

// Routes
const routes = [
	{
		name: 'VendorDashboard',
		path: '/vendor/',
		component: VendorDashboard
	},
	{
		name: 'VendorServices',
		path: '/vendor/services',
		component: VendorServices
	},
	{
		name: 'VendorNewService',
		path: '/vendor/services/new/:id?',
		component: VendorNewService
	},
	{
		name: 'VendorProfile',
		path: '/vendor/profile',
		component: VendorProfile
	},
	{
		name: 'BuyerRequests',
		path: '/vendor/buyer-requests',
		component: BuyerRequests
	},
	{
		name: 'UserDashboard',
		path: '/user/',
		component: UserDashboard
	},
	{
		name: 'UserRequests',
		path: '/user/requests',
		component: UserRequests
	},
	{
		name: 'PostRequest',
		path: '/user/post-request/:id?',
		component: PostRequest
	},
	{
		name: 'UserProfile',
		path: '/user/profile',
		component: UserProfile
	},

	// Error page
	{
		path: '/vendor/*',
		component: ErrorPage
	},
	{
		path: '/user/*',
		component: ErrorPage
	},
];
const router = new VueRouter({ mode: 'history', routes: routes });

// Standalone components
Vue.component('register', require('./components/Register.vue').default);
Vue.component('quick-login', require('./components/QuickLogin.vue').default);
Vue.component('services-overview', require('./components/sections/ServicesOverview.vue').default);
Vue.component('featured-services', require('./components/sections/FeaturedServices.vue').default);
Vue.component('footer-categories', require('./components/sections/FooterCategories.vue').default);

Vue.component('load-services-in-category', require('./components/sections/CategoryOverview.vue').default);
Vue.component('load-services-in-sub-category', require('./components/sections/SubCategoryOverview.vue').default);
Vue.component('service-review', require('./components/sections/ServiceReview.vue').default);
Vue.component('message', require('./components/sections/Message.vue').default);

// Goodshare
import VueGoodshareFacebook from "vue-goodshare/src/providers/Facebook.vue";
import VueGoodshareTwitter from "vue-goodshare/src/providers/Twitter.vue";
import VueGoodshareLinkedIn from "vue-goodshare/src/providers/LinkedIn.vue";
import VueGoodshareWhatsApp from "vue-goodshare/src/providers/WhatsApp.vue";
import VueGoodshareTelegram from "vue-goodshare/src/providers/Telegram.vue";
import VueGoodshareEmail from "vue-goodshare/src/providers/Email.vue";

const app = new Vue({
    el: '#app',
    router,
    data: {
    	global_search: ''
    },
    methods: {
    	searchServices() {
    		// window.location.hash = "services_overview"
    		Fire.$emit('searching')
    	}
    },
    components: {
    	VueGoodshareFacebook,
    	VueGoodshareTwitter,
    	VueGoodshareLinkedIn,
    	VueGoodshareWhatsApp,
    	VueGoodshareTelegram,
    	VueGoodshareEmail
    }
});

