
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

//Store
import store from './store';

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
import VueClipboard from 'vue-clipboard2'
import VueSocialSharing from 'vue-social-sharing'
 
Vue.use(VueSocialSharing);
 
Vue.use(VueClipboard)
Vue.use(Loading, {
	loader: 'bars',
});

// event emitter
window.Fire = new Vue();

// Paginator
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

// Components
import AdminDashboard from './components/admin/Dashboard.vue';
import AdminProfile from './components/Profile.vue';
import AdminStates from './components/admin/States.vue';
import AdminCities from './components/admin/Cities.vue';
import AdminCategories from './components/admin/Categories.vue';
import AdminSubCategories from './components/admin/SubCategories.vue';
import AdminServices from './components/admin/Services.vue';
import AdminNewService from './components/admin/NewService.vue';
import AdminVendors from './components/admin/Vendors.vue';
import AdminUsers from './components/admin/Users.vue';
import AdminSubscribers from './components/admin/Subscribers.vue';
import AdminMessages from './components/admin/Messages.vue';
import AdminServicePages from './components/admin/ServicePages.vue';
import AdminServiceLink from './components/admin/ServiceLink.vue';
import AdminUnfoundSearches from './components/admin/UnfoundSearches.vue';
import AdminContactMessages from './components/admin/Contacts.vue';
import AdminAdverts from './components/admin/Adverts.vue';
import Payments from './components/admin/Payments.vue';

import VendorDashboard from './components/vendor/Dashboard.vue';
import VendorProfile from './components/Profile.vue';
import VendorServices from './components/vendor/Services.vue';
import VendorAdvertise from './components/vendor/Advertise.vue';
import VendorNewService from './components/vendor/NewService.vue';

import UserDashboard from './components/user/Dashboard.vue';
import UserRequests from './components/user/UserRequests.vue';
import PostRequest from './components/user/PostRequest.vue';
import UserProfile from './components/Profile.vue';
import VisitorsStats from './components/admin/Stats.vue';
import NewServices from './components/admin/NewServices.vue';


import PromoteService from './components/Promote.vue';
import ErrorPage from './components/404.vue';

// Routes
const routes = [

	// Admin
	{
		name: 'AdminDashboard',
		path: '/admin/',
		component: AdminDashboard
	},
	{
		name: 'AdminServiceLink',
		path: '/admin/servicelink',
		component: AdminServiceLink
	},
	{
		name: 'VisitorsStats',
		path: '/admin/stats',
		component: VisitorsStats
	},
	{
		name: 'AdminPayments',
		path: '/admin/payments',
		component: Payments
	},
	{
		name: 'NewServices',
		path: '/admin/newservices',
		component: NewServices
	},
	{
		name: 'AdminServices',
		path: '/admin/services',
		component: AdminServices
	},
	{
		name: 'AdminCategories',
		path: '/admin/categories',
		component: AdminCategories
	},
	{
		name: 'AdminSubCategories',
		path: '/admin/subcategories',
		component: AdminSubCategories
	},
	{
		name: 'AdminStates',
		path: '/admin/states',
		component: AdminStates
	},
	{
		name: 'AdminCities',
		path: '/admin/cities',
		component: AdminCities
	},
	{
		name: 'AdminNewService',
		path: '/admin/services/new/:id?',
		component: AdminNewService
	},
	{
		name: 'AdminVendors',
		path: '/admin/vendors',
		component: AdminVendors
	},
	{
		name: 'AdminUsers',
		path: '/admin/users',
		component: AdminUsers
	},
	{
		name: 'AdminSubscribers',
		path: '/admin/subscribers',
		component: AdminSubscribers
	},
	{
		name: 'AdminMessages',
		path: '/admin/messages',
		component: AdminMessages
	},
	{
		name: 'AdminServicePages',
		path: '/admin/servicepages',
		component: AdminServicePages
	},
	{
		name: 'AdminUnfoundSearches',
		path: '/admin/unfound-searches',
		component: AdminUnfoundSearches
	},
	{
		name: 'AdminContactMessages',
		path: '/admin/contact-messages',
		component: AdminContactMessages
	},
	{
		name: 'AdminAdverts',
		path: '/admin/adverts',
		component: AdminAdverts
	},
	{
		name: 'AdminProfile',
		path: '/admin/profile',
		component: AdminProfile
	},

	// Vendors
	{
		name: 'VendorDashboard',
		path: '/vendor/',
		component: VendorDashboard
	},
	{
		name: 'VendorPayments',
		path: '/vendor/payments',
		component: Payments
	},
	{
		name: 'VendorServices',
		path: '/vendor/services',
		component: VendorServices
	},
	{
		name: 'PromoteService',
		path: '/vendor/promote/:id',
		component: PromoteService
	},
	{
		name: 'VendorAdvertise',
		path: '/vendor/advertise',
		component: VendorAdvertise
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

	// Users
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
		path: '/admin/*',
		component: ErrorPage
	},
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
Vue.component('footer-categories', require('./components/sections/FooterCategories.vue').default);

Vue.component('load-services-in-category', require('./components/sections/CategoryOverview.vue').default);
Vue.component('load-services-in-sub-category', require('./components/sections/SubCategoryOverview.vue').default);
Vue.component('service-review', require('./components/sections/ServiceReview.vue').default);
Vue.component('donate-page', require('./components/Donate.vue').default);
Vue.component('message', require('./components/sections/Message.vue').default);
Vue.component('drop-phone-number', require('./components/sections/DropPhoneNumber.vue').default);
Vue.component('service-page', require('./components/ServicePage.vue').default);

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
    store,
    data: {
    	global_search: '',
    	global_search_address: '',
    },
    methods: {
    	searchServices() {
    		Fire.$emit('searching')
    	},
    	
    	getMyLocation() {
			fetch('https://ipapi.co/json/')
			.then((response) => {
				response.json()
				.then((data) => {
					this.global_search_address = data.city
				})
			})
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

