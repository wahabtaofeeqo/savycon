<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="@yield('description', 'Hire a vendor for your project')">
        <meta name="author" content="Adeyinka M. Adefolurin">
        <meta name="keywords" content="freelance, jobs, career, service, vendor, worker">

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

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('master/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('master/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('master/css/light-bootstrap-dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('master/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" href="{{ asset('main/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

        <style type="text/css">
        	li .router-link-exact-active.router-link-active {
        		color: #FFFFFF !important;
				opacity: 1;
				background: rgba(255, 255, 255, 0.23) !important;
        	}
        </style>
	</head>
	<body>
		<div id="app">
			<div class="wrapper">
				<div class="sidebar" data-color="green" data-image="{{ asset('master/img/sidebar-4.jpg') }}">
					<div class="sidebar-wrapper">
						<div class="logo">
			                <a href="{{ route('index') }}" class="simple-text">
			                    SavyCon
			                </a>
			            </div>

			            <ul class="nav">
			            	@can('isVendor')
				            	<li>
				            		<router-link :to="{ name: 'VendorDashboard' }">
				            			<i class="pe-7s-home"></i>
				            			<p>Dashboard</p>
				            		</router-link>
				            	</li>
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
				            	<li>
				            		<router-link :to="{ name: 'BuyerRequests' }">
				            			<i class="pe-7s-speaker"></i>
				            			<p>Buyer Requests</p>
				            		</router-link>
				            	</li>
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
								&copy; @php echo date("Y") @endphp Developed by <a href="tel:{{ config('app.developer.phone') }}">{{ config('app.developer.name') }}</a>
							</p>
						</div>
					</footer>
				</div>
			</div>
		</div>

		<script src="{{ asset('js/app.js') }}"></script>
	    <script src="{{ asset('master/js/bootstrap-checkbox-radio-switch.js') }}"></script>
	    <script src="{{ asset('master/js/light-bootstrap-dashboard.js') }}"></script>
	</body>
</html>