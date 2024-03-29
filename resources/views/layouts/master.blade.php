<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="@yield('description', 'Hire a vendor for your project')">
        <meta name="author" content="Josiah Akinloye">
        <meta name="robots" content="index, follow">
        <meta name="language" content="English">
        <meta name="keywords" content="freelance,jobs,career,service,vendor,worker">

		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
 <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ route('index') }}">
        <meta property="og:title" content="@yield('title', 'SavyCon')">
        <meta property="og:description" content="@yield('description', 'Hire a vendor for your project')">
        <meta property="og:image" content="{{ asset('logo.png') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ route('index') }}">
        <meta property="twitter:title" content="@yield('title', 'SavyCon')">
        <meta property="twitter:description" content="@yield('description', 'Hire a vendor for your project')">
        <meta property="twitter:image" content="{{ asset('logo.png') }}">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | {{ ucfirst(Auth::user()->role) }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('master/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('master/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('master/css/light-bootstrap-dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('master/css/pe-icon-7-stroke.css') }}">

        <style type="text/css">
        	li .router-link-exact-active.router-link-active {
        		color: #FFFFFF !important;
				opacity: 1;
				background: rgba(255, 255, 255, 0.23) !important;
        	}
        	.navbar-right li .btn {
        		color: white !important;
        	}
        	.navbar-right li .btn-fill:hover {
        		color: black !important;
        	}
        	.navbar-right li .router-link-exact-active.router-link-active {
        		color: black !important;
        	}
        </style>
        <!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i) {
				w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-TTQVJ4V');
		</script>
		<!-- End Google Tag Manager -->

		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTQVJ4V" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->
	</head>
	<body>
		<div id="app">
			<div class="wrapper">
				<div class="sidebar" data-color="green" data-image="{{ asset('master/img/sidebar-'.rand(1,5).'.jpg') }}">
					<div class="sidebar-wrapper">
						<a class="logo-tim" href="{{ route('index') }}" style="border: 0; background: white; position: absolute; margin: 7px 20px; width: 45px; height: 45px;">
							<img src="{{ asset('logo.png') }}" style="width: 45px; height: 45px;">
						</a>
						<div class="logo">
			                <a class="simple-text" href="{{ route('index') }}" style="text-transform: none; font-weight: bold; letter-spacing: 1px;">
			                    SavyCon
			                </a>
			            </div>

			            <ul class="nav">
			            	@can('isAdmin')
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminDashboard' }">
				            			<i class="pe-7s-home"></i>
				            			<p>Dashboard</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'VisitorsStats' }">
				            			<i class="pe-7s-map"></i>
				            			<p>Visitors Stats</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'NewServices' }">
				            			<i class="pe-7s-map"></i>
				            			<p>New Services 
				            				<span class="badge badge-danger"> 
				            					{{session()->get('services')}}
				            				</span>
				            			</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminStates' }">
				            			<i class="pe-7s-map"></i>
				            			<p>States</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminCities' }">
				            			<i class="pe-7s-map-2"></i>
				            			<p>Cities</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminCategories' }">
				            			<i class="pe-7s-way"></i>
				            			<p>Categories</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminSubCategories' }">
				            			<i class="pe-7s-way"></i>
				            			<p>Sub Categories</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminAdverts' }">
				            			<i class="pe-7s-signal"></i>
				            			<p>Adverts</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminServices' }">
				            			<i class="pe-7s-portfolio"></i>
				            			<p>Services</p>
				            		</router-link>
				            	</li>
				            	<li class="nav-item">
				            		<router-link :to="{ name: 'AdminVendors' }">
				            			<i class="pe-7s-users"></i>
				            			<p>Vendors</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminUsers' }">
				            			<i class="pe-7s-users"></i>
				            			<p>Buyers</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminSubscribers' }">
				            			<i class="pe-7s-news-paper"></i>
				            			<p>Subscribers</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminMessages' }">
				            			<i class="pe-7s-chat"></i>
				            			<p>Messages</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminContactMessages' }">
				            			<i class="pe-7s-phone"></i>
				            			<p>Contact Messages</p>
				            		</router-link>
				            	</li>
								<li>
				            		<router-link :to="{ name: 'AdminServicePages' }">
				            			<i class="pe-7s-chat"></i>
				            			<p>Service Page</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminUnfoundSearches' }">
				            			<i class="pe-7s-search"></i>
				            			<p>Unfound Searches</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminPayments' }">
				            			<i class="pe-7s-search"></i>
				            			<p>Payments</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'AdminProfile' }">
				            			<i class="pe-7s-user"></i>
				            			<p>Profile</p>
				            		</router-link>
				            	</li>
				            @endcan
			            	@can('isVendor')
				            	<li>
				            		<router-link :to="{ name: 'VendorDashboard' }">
				            			<i class="pe-7s-home"></i>
				            			<p>Dashboard</p>
				            		</router-link>
				            	</li>
				            	@can('isVendorActive')
				            	<li>
				            		<router-link :to="{ name: 'VendorServices' }">
				            			<i class="pe-7s-portfolio"></i>
				            			<p>Services</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'VendorNewService' }">
				            			<i class="pe-7s-plug"></i>
				            			<p>Add New Service</p>
				            		</router-link>
				            	</li>
				            	<li style="display: none;">
				            		<router-link :to="{ name: 'VendorAdvertise' }">
				            			<i class="pe-7s-portfolio"></i>
				            			<p>Advertise</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'VendorPayments' }">
				            			<i class="pe-7s-search"></i>
				            			<p>Payments</p>
				            		</router-link>
				            	</li>
				            	@endcan
				            	<li>
				            		<router-link :to="{ name: 'VendorProfile' }">
				            			<i class="pe-7s-user"></i>
				            			<p>Profile</p>
				            		</router-link>
				            	</li>
				            @endcan
		            		@can('isUser')
			            		<li>
				            		<router-link :to="{ name: 'UserDashboard' }">
				            			<i class="pe-7s-home"></i>
				            			<p>Dashboard</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'UserRequests' }">
				            			<i class="pe-7s-notebook"></i>
				            			<p>Requests</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'PostRequest' }">
				            			<i class="pe-7s-news-paper"></i>
				            			<p>Post a Request</p>
				            		</router-link>
				            	</li>
				            	<li>
				            		<router-link :to="{ name: 'UserProfile' }">
				            			<i class="pe-7s-user"></i>
				            			<p>Profile</p>
				            		</router-link>
				            	</li>
		            		@endcan
			            </ul>
					</div>
				</div>

				<div class="main-panel">
					<nav class="navbar navbar-default navbar-fixed">
			            <div class="container-fluid">
			                <div class="navbar-header">
			                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
			                        <span class="sr-only">Toggle navigation</span>
			                        <span class="icon-bar"></span>
			                        <span class="icon-bar"></span>
			                        <span class="icon-bar"></span>
			                    </button>
			                    <a class="navbar-brand" href="#">{{ Auth::user()->name }}</a>
			                </div>
			                <div class="collapse navbar-collapse">
			                    <ul class="nav navbar-nav navbar-right">
			                    	@can('isActiveVendorOrAdmin')
			                    	<li>
			                    		@if(Auth::user()->role === 'vendor')
			                    		<router-link :to="{ name: 'VendorNewService' }" class="btn btn-fill btn-primary" style="text-transform: uppercase;">
					            			<i class="pe-7s-plug"></i>
					            			Add New Service
					            		</router-link>
					            		@else
					            		<router-link :to="{ name: 'AdminNewService' }" class="btn btn-fill btn-primary" style="text-transform: uppercase;">
					            			<i class="pe-7s-plug"></i>
					            			Add New Service
					            		</router-link>
					            		@endif
			                    	</li>
			                    	@endcan
			                        <li>
			                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
			                             document.getElementById('logout-form').submit();">
			                                <p><i class="pe-7s-back-2"></i> Sign out</p>
			                            </a>

			                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				                            @csrf
				                        </form>
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </nav>

			        <div class="content">
			        	<div class="container-fluid">
			        		<router-view></router-view>
			        	</div>
			        </div>

			        <footer class="footer">
						<div class="container-fluid">
							<nav class="pull-left">
								<ul>
									<li>
										<a href="{{ route('index') }}" target="__blank">Home</a>
									</li>
									<li>
										<a href="{{ route('about') }}" target="__blank">About</a>
									</li>
									<li>
										<a href="{{ route('terms') }}" target="__blank">Terms of Use</a>
									</li>
									<li>
										<a href="{{ route('privacyPolicy') }}" target="__blank">Privacy Policy</a>
									</li>
								</ul>
							</nav>
							<p class="copyright pull-right">
								&copy; @php echo date("Y") @endphp <!-- Developed by <a href="{{ config('app.developer.website') }}">{{ config('app.developer.name') }} --></a>
							</p>
						</div>
					</footer>
				</div>
			</div>
		</div>

		<script src="https://checkout.flutterwave.com/v3.js"></script>
		<script src="{{ asset('js/app.js') }}"></script>
	    <script src="{{ asset('master/js/bootstrap-checkbox-radio-switch.js') }}"></script>
	    <script src="{{ asset('master/js/light-bootstrap-dashboard.js') }}"></script>
	</body>
</html>
