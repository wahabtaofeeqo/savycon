@php
    if(request()->is('/')){
        $page__id = get_static_option('home_page');
        $page_details = App\Page::find($page__id);
        $page_post = isset($page_post) && is_null($page_details) ? $page_post : $page_details;
    }
@endphp
<nav class="navbar navbar-area navbar-two {{ $page_post->page_class ?? '' }} navbar-expand-lg">
    <div class="container container-tw nav-container py-0">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper">
                <a href="{{ route('homepage') }}" class="logo">
                    <img src="{{asset('assets/uploads/logo.png')}}" alt="logo" height="45">
                    {{-- {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!} --}}
                </a>
            </div>

            <div class="onlymobile-device-account-navbar navtwo">
                <div class="onlymobile-device-account-navbar-flex">
                    <div class="navbar-right-inner">
                        <x-frontend.user-menu/>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler black-color" type="button" data-bs-toggle="collapse"
                    data-bs-target="#bizcoxx_main_menu_navabar_two" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bizcoxx_main_menu_navabar_two">
            <ul class="navbar-nav">
                {{-- {!! render_frontend_menu($primary_menu) !!} --}}
                <li>
                    <a href="">Home</a>
                </li>
                <li>
                    <a href="">About Us</a>
                </li>
                <li>
                    <a href="">Contact Us</a>
                </li>
                <li>
                    <a href="">Categories</a>
                </li>
                <li>
                    <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Donate
                    </button>
                </li>
            </ul>
        </div>

        <div class="nav-right-content">
            <div class="navbar-right-inner">
                <div class="info-bar-item">
                    @if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0)
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0)
                            <div class="notification-icon icon">
                                @if(Auth::guard('web')->check())
                                    <i class="las la-bell"></i>
                                    <span class="notification-number style-02">
                                {{ Auth()->user()->unreadNotifications()->count() }}
                            </span>
                                @endif

                                <div class="notification-list-item mt-2">
                                    <h5 class="notification-title">{{ __('Notifications') }}</h5>
                                    <div class="list">
                                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->count() >=1)
                                            <span>
                                        @foreach(Auth::user()->unreadNotifications->take(5) as $notification)

                                          <!-- seller ticket Notifications-->
                                        @foreach(Auth::guard('web')->user()->unreadNotifications->take(10) as $notification)
                                            @if(isset($notification->data['seller_last_ticket_id']))
                                                <a class="list-order" href="{{ route('seller.support.ticket.view',$notification->data['seller_last_ticket_id']) }}">
                                                <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                {{ $notification->data['order_ticcket_message']  }} #{{ $notification->data['seller_last_ticket_id'] }}
                                            </a>
                                              @endif
                                        @endforeach

                                          <!-- seller order Notifications-->
                                        @if(isset($notification->data['order_id']))
                                            <a class="list-order" href="{{ route('seller.order.details',$notification->data['order_id']) }}">
                                                <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                {{ $notification->data['order_message'] }} #{{ $notification->data['order_id'] }}
                                            </a>
                                        @endif
                                    @endforeach

                                    </span>
                                            <a class="p-2 text-center d-block" href="{{ route('seller.notification.all') }}">{{ __('View All Notification') }}</a>
                                        @else
                                            <p class="text-center padding-3">{{ __('No New Notification') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <x-frontend.user-menu/>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Your Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" id="donationForm" action="#">
            <div class="modal-body">
                <div class="form-group m-b-20">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    {{-- <has-error :form="form" field="email"></has-error> --}}
                </div>

                <div class="form-group m-b-20">
                    <input type="number" name="amount" class="form-control" placeholder="Amount" id="amount" required>
                    {{-- <has-error :form="form" field="amount"></has-error> --}}
                </div>

                <div class="form-group m-b-20">
                    <input type="tel" name="phone" class="form-control" :class="{ 'has-error':form.errors.has('phone') }" v-model="form.phone" placeholder="Phone number" id="phone" aria-describedby="addon-phone" minlength="10" maxlength="10" required>
                    {{-- <has-error :form="form" field="phone"></has-error> --}}
                </div>

                <div class="form-group">
                    <div class="bor8 how-pos4-parent">
                        <select name="currency" class="form-control" id="currency" required>
                            <option disabled value="">Select your Currency</option>
                            <option value="NGN">Naira</option>
                            <option value="USD">US Dollar</option>
                        </select>
                    </div>
                    {{-- <has-error :form="form" field="currency"></has-error> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success px-4">Continue</button>
            </div>
        </form>
      </div>
    </div>
</div>