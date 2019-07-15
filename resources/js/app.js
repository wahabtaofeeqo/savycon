
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
	position: 'center',
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


const app = new Vue({
    el: '#app',
    router
});

