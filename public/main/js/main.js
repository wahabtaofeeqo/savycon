
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
    
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });
        
    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });
    
    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });


    //For Custom Dialog when users leaves services Page
    $("a").click(function(e) {
        e.preventDefault();
        
        const currentPage = window.location.href;
        const url = $(this).attr('href');

        const arr = currentPage.split("/");
        const page = arr[arr.length - 1];

        if (page == 'services') {

            axios.get('/api/user-need-session')
            .then((response) => {
                
                if (response.data.asked) {
                    needPopup(url, currentPage);
                }
                else {
                    window.location.href = url;
                }
            })
            .catch((err) => {
                console.log(err);
            })
        }
        else {
            if (url != window.location.href) {
                window.location.href = url;
            }
        }
    });

    const needPopup = function(url, currentPage) {
        Swal.fire({
            title: '<strong>Just a moment!</strong>',
            icon: 'info',
            html: '<p class="py-2 text-muted"> Do you get what you want? if YES please click the link below and RATE us</p>',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> No!',
                footer: '<p class="text-success">Thanks for visiting!</p>'
        }).then(async (result) => {

            if (result.isConfirmed) {

                Swal.fire({
                        text: 'Thanks for visiting!',
                        toast: true,
                        position: 'bottom-right',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success'
                });

                if (url != currentPage) {
                    window.location.href = url;
                }
            }
            else {
                    
                const { value: userInput } = await Swal.fire({
                    title: 'Tell us what you need',
                    input: 'textarea',
                    showCancelButton: true,
                    inputPlaceholder: 'Type.......',
                    inputValidator: (value) => {
                            if (!value) {
                                return "Please tell us what you need";
                            }
                        }
                    });

                if (userInput) {

                    $.ajax({
                        type: 'POST',
                        url: '/api/usersNeed',
                        data: {need: userInput},
                        success: function(response) {

                            console.log(response);
                            Swal.fire({
                                text: 'Thanks for visiting!',
                                toast: true,
                                position: 'bottom-right',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success'
                            });

                            if (url != window.location.href) {
                                window.location.href = url;
                            }
                        },
                        error: function(err) {
                               
                        }
                    });
                }
            }
        });
    }

    const setCookie = function(name, value, expires) {

        const date = new Date();
        date.setTime(date.getTime + (expires * (24 * 60 * 60 * 1000)));
        const exp = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + exp + ";path=/";
    };

    const getCookie = function(cookieName) {
        const name = cookieName + "=";
        const cookies = decodeURIComponent(document.cookie);
        const parts = cookies.split(";");

        for (var i = 0; i < parts.length; i++) {
            
            let c = parts[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }

            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }

        return "";
    };

    //Newsletter Popup
    const newsLetterBox = async function() {

        if (getCookie("subscribe") != "") return;

        const { value: email } = await Swal.fire({
                title: 'Subscribe to Newsletter',
                input: 'email',
                showCancelButton: true,
                inputPlaceholder: 'Email...',
                inputValidator: (value) => {
                    if (!value) {
                        return "Enter Email!";
                    }
                }
            });

            if (email) {

                const data = {
                    email: email
                };

                axios.post('/api/subscribe', data).then(response => {
                    setCookie("subscribe", email, 365);
                    Swal.fire({
                        text: 'Thanks for subscribing!',
                        toast: true,
                        position: 'bottom-right',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success'
                    });
                }).catch(err => {})
            }
        };

    const popup = function() {

        
    };

    const getIp = function() {
        axios.get('https://api.ipify.org?format=json')
        .then(response => {
            axios.post('/api/visitors', {ip: response.data.ip}).then(async (response) => {
                if (response.data.show) {
                    newsLetterBox();
                }
            }).catch(err => {});
        }).catch(err => {});
    }

    setTimeout(getIp, (1000));

})(jQuery);