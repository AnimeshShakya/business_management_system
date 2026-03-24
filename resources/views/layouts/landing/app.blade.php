<!DOCTYPE html>
@php
    $site_direction = session()->get('landing_site_direction');
@endphp
<html lang="en" dir="{{$site_direction}}">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>@yield('title')</title>

    <meta property="og:image"
          content="{{asset('storage/app/public/landing-page/meta')}}/{{bs_data($settings,'meta_image', 1,true)}}"/>
    <meta property="og:title" content="{{bs_data($settings,'meta_title', 1,true)}}"/>
    <meta property="og:description" content="{{bs_data($settings,'meta_description', 1,true)}}">

    <link href="{{asset('public/assets/provider-module')}}/css/material-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/landing')}}/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/landing')}}/css/line-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/landing')}}/css/owl.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/landing')}}/css/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/landing')}}/css/main.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/css/toastr.css">

    <link rel="shortcut icon"
          href="{{asset('storage/app/public/business')}}/{{bs_data($settings,'business_favicon', 1)}}"
          type="image/x-icon"/>

    <style>
        :root {
            --bs-body-bg: {{bs_data($settings,'body_background', 1,true)}};
            --header-bg: {{bs_data($settings,'header_background', 1,true)}};
            --footer: {{bs_data($settings,'footer_background', 1,true)}};
            --footer-bottom: {{bs_data($settings,'header_background', 1,true)}};
        }

        .dark-theme {
            --bs-body-bg: #121213;
            --header-bg: #11202be6;
            --footer: #001f35;
            --footer-bottom: #111a21;
        }

        .dynamic-page-wrapper h1,
        .dynamic-page-wrapper h2,
        .dynamic-page-wrapper h3,
        .dynamic-page-wrapper h4,
        .dynamic-page-wrapper h5,
        .dynamic-page-wrapper h6,
        .dynamic-page-wrapper ul{
            margin-bottom: 1.5rem !important;
        }
    </style>
</head>

<body>
<script>
    if (localStorage.landingTheme) {
        document.body.classList.add(localStorage.landingTheme);
    }


</script>
<div class="preloader"></div>
<div class="navbar-top">
    <div class="container">
        <div class="navbar-top-wrapper">
            <div class="mode--toggle">
                <img src="" alt="">
            </div>
            <div class="hs-unfold top-padding">
                <div>
                    @php( $local = session()->has('landing_local')?session('landing_local'):'en')
                    @php($siteDirection = session()->has('landing_site_direction')?session('landing_site_direction'):'ltr')
                    @php($lang = Modules\BusinessSettingsModule\Entities\BusinessSettings::where('key_name','system_language')->first())
                    @if ($lang)
                        <div class="topbar-text dropdown d-flex">
                            <a class="topbar-link dropdown-toggle d-flex align-items-center title-color gap-1 lagn-drop-btn justify-content-between align-items-center"
                               href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @foreach ($lang['live_values'] as $data)
                                    @if($data['code']==$local)
                                        @php($language = collect(LANGUAGES)->where('code', $data['code'])->first())
                                        @if($language)
                                            <span class="d-flex align-items-center gap-2">
                                                <span class="material-icons">language</span>
                                                {{ $language['nativeName'] }}
                                                <span class="fz-10">({{ $data['code'] }})</span>
                                            </span>
                                        @else
                                            {{ $data['code'] }}
                                        @endif
                                    @endif
                                @endforeach
                            </a>
                            <ul class="dropdown-menu lang-menu">
                                @foreach($lang['live_values'] as $key =>$data)
                                    @if($data['status']==1)
                                        @php($language = collect(LANGUAGES)->where('code', $data['code'])->first())
                                        <li>
                                            <a class="dropdown-item d-flex gap-2 align-items-center py-2 justify-content-between"
                                               href="{{route('lang',[$data['code']])}}">
                                               <div class="d-flex gap-2 align-items-center">
                                                @if($language)
                                                    <span class="text-capitalize">
                                                        {{ $language['nativeName'] }}
                                                        <span class="fz-10">({{ $data['code'] }})</span>
                                                    </span>

                                                    @else
                                                        <span class="text-capitalize">{{ $data['code'] }}</span>
                                                    @endif
                                               </div>
                                               <span class="material-symbols-outlined text-muted">check_circle</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
            <div class="top-padding">
                <a href="tel:{{bs_data($settings,'business_phone', 1)}}"
                   class="tel-link text--base">
                    <i class="las la-phone"></i>
                    {{bs_data($settings,'business_phone', 1)}}
                </a>
            </div>
        </div>
    </div>
</div>
<header>
    @php($logo = getBusinessSettingsImageFullPath(key: 'business_logo', settingType: 'business_information', path: 'business/', defaultPath: 'public/assets/placeholder.png'))

    <div class="navbar-bottom">
        <div class="container">
            <div class="navbar-bottom-wrapper">
                <a href="{{route('home')}}" class="logo">
                    <img alt="{{translate('business logo')}}" src="{{ $logo }}">
                </a>
                <ul class="menu me-lg-4">
                    <li>
                        <a href="{{route('home')}}"
                           class="{{request()->is('/')?'active':''}}"><span>{{translate('home')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('home')}}#service"><span>{{translate('our_service')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('business.page.dynamic', ['slug' => 'about-us'])}}" class="{{request()->is('business-page/about-us')?'active':''}}">
                            <span>{{translate('about_us')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('business.page.dynamic', ['slug' => 'privacy-policy'])}}" class="{{request()->is('business-page/privacy-policy')?'active':''}}">
                            <span>{{translate('privacy_policy')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('business.page.dynamic', ['slug' => 'terms-and-conditions'])}}" class="{{request()->is('business-page/terms-and-conditions')?'active':''}}">
                            <span>{{translate('terms_&_conditions')}}</span>
                        </a>
                    </li>
                </ul>
                <div class="nav-toggle d-lg-none ms-auto me-2 me-sm-4">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <a href="{{route('page.contact-us')}}" class="cmn--btn">{{translate('contact_us')}}</a>
            </div>
        </div>
    </div>
</header>

@yield('content')

<div class="py-75 subscribe-newsletter">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-5">
                <h3 class="text-uppercase text--base mb-2">{{ bs_data_text($settingss, 'newsletter_title', 1) }}</h3>
                <p class="text--base">{{ bs_data_text($settingss, 'newsletter_description', 1) }}</p>
            </div>
            <div class="col-md-6">
                <form method="post" action="{{ route('subscribe-newsletter') }}">
                    @csrf
                    <div class="input-group">
                        <input class="form-control p-3 rounded-pill" type="email" name="email" placeholder="{{ translate('Type email...') }}" required>
                        <div class="input-group-append">
                            <button class="cmn--btn rounded-pill subscribe-btn" type="submit">{{ translate('subscribe') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="main-footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer__wrapper">
                    <div class="footer__wrapper-widget">
                        <div class="cont">
                            <a href="#" class="logo mb-4">
                                <img src="{{ $logo }}" alt="{{translate('logo')}}">
                            </a>
                            <p class="mb-4">{{translate('Connect with our social media and other sites to keep up to date')}}</p>
                            <div class="app-btns">
                                @if($settings->where('key_name','app_url_appstore')->first()->is_active??0)
                                    <a href="{{bs_data($settings,'app_url_appstore', 1)}}" class="d-block">
                                        <img class="w-100" src="{{asset('public/assets/landing/img/app-btn/app-store.png')}}" alt="{{translate('app store')}}">
                                    </a>
                                @endif

                                @if($settings->where('key_name','app_url_playstore')->first()->is_active??0)
                                    <a href="{{bs_data($settings,'app_url_playstore', 1)}}" class="d-block">
                                        <img class="w-100" src="{{asset('public/assets/landing/img/app-btn/google-play.png')}}" alt="{{translate('play store')}}">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @php($footerPages = \Modules\BusinessSettingsModule\Entities\BusinessPageSetting::where('is_active', 1)->orderBy('created_at', 'ASC')->get()))
                    <div class="footer__wrapper-widget">
                        <ul class="footer__wrapper-link">
                            <li>
                                <a href="{{route('home')}}">{{translate('home')}}</a>
                            </li>
                            <li>
                                <a href="{{route('page.contact-us')}}">{{translate('contact_us')}}</a>
                            </li>
                            @foreach($footerPages as $footerPage)
                                <li>
                                    <a class="text-capitalize" href="{{route('business.page.dynamic', ['slug' => $footerPage->page_key])}}">{{ $footerPage->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="footer__wrapper-widget">
                        <div class="footer__wrapper-contact">
                            <img class="icon" src="{{asset('public/assets/landing/img/footer/mail.png')}}" alt="{{translate('footer')}}">
                            <h6>
                                {{translate('send_us_mail')}}
                            </h6>
                            <a href="Mailto:{{bs_data($settings,'business_email', 1)}}">{{bs_data($settings,'business_email', 1)}}</a>
                        </div>
                    </div>
                    <div class="footer__wrapper-widget">
                        <div class="footer__wrapper-contact">
                            <img class="icon" src="{{asset('public/assets/landing/img/footer/tel.png')}}" alt="{{translate('footer')}}">
                            <h6>
                                {{translate('contact_us')}}
                            </h6>
                            <a href="Tel:{{bs_data($settings,'business_phone', 1)}}">{{bs_data($settings,'business_phone', 1)}}</a>
                        </div>
                    </div>
                    <div class="footer__wrapper-widget">
                        <div class="footer__wrapper-contact">
                            <img class="icon" src="{{asset('public/assets/landing/img/footer/pin.png')}}" alt="{{translate('footer')}}">
                            <h6>
                                {{translate('find_us_here')}}
                            </h6>
                            <div><span>{{bs_data($settings,'business_address', 1)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center py-3">
            {{bs_data($settings,'footer_text', 1)}}
        </div>
    </div>
</footer>

<script src="{{asset('public/assets/landing')}}/js/jquery-3.6.0.min.js"></script>
<script src="{{asset('public/assets/landing')}}/js/viewport.jquery.js"></script>
<script src="{{asset('public/assets/landing')}}/js/wow.min.js"></script>
<script src="{{asset('public/assets/landing')}}/js/owl.min.js"></script>
<script src="{{asset('public/assets/landing')}}/js/swiper-bundle.min.js"></script>
<script src="{{asset('public/assets/landing')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/assets/admin-module')}}/js/toastr.js"></script>
<script src="{{asset('public/assets/landing')}}/js/custom.js"></script>

{!! Toastr::message() !!}

<script>
    "use strict";

    (function ($) {
        $(document).ready(function () {
            $(".accordion-title").on("click", function (e) {
                var element = $(this).parent(".accordion-item");
                if (element.hasClass("open")) {
                    element.removeClass("open");
                    element.find(".accordion-content").removeClass("open");
                    element.find(".accordion-content").slideUp(200, "swing");
                } else {
                    element.addClass("open");
                    element.children(".accordion-content").slideDown(200, "swing");
                    element
                        .siblings(".accordion-item")
                        .children(".accordion-content")
                        .slideUp(200, "swing");
                    element.siblings(".accordion-item").removeClass("open");
                    element
                        .siblings(".accordion-item")
                        .find(".accordion-title")
                        .removeClass("open");
                    element
                        .siblings(".accordion-item")
                        .find(".accordion-content")
                        .slideUp(200, "swing");
                }
            });

            let fixed_top = $(".navbar-bottom");
            $(window).on("scroll", function () {
                if ($(this).scrollTop() > 110) {
                    fixed_top.addClass("active");
                } else {
                    fixed_top.removeClass("active");
                }
            });

            $(".owl-prev").html('<i class="fas fa-angle-left">');
            $(".owl-next").html('<i class="fas fa-angle-right">');

            if ($(".wow").length) {
                var wow = new WOW({
                    boxClass: "wow",
                    animateClass: "animated",
                    offset: 0,
                    mobile: true,
                    live: true,
                });
                wow.init();
            }

            $(".mode--toggle").on("click", function () {
                if(localStorage.getItem('landingTheme') == 'light-theme'){
                    localStorage.setItem('landingTheme', 'dark-theme');
                }else{
                    localStorage.setItem('landingTheme', 'light-theme');
                }
                setTheme(localStorage.getItem("landingTheme"));
            });

            setTheme(localStorage.getItem("landingTheme"));

            function setTheme(theme) {
                if (theme == "dark-theme") {
                    $("body").addClass('dark-theme');
                    $(".mode--toggle").find("img").attr("src", "{{asset('public/assets/landing')}}/img/moon.png");
                } else {
                    $("body").removeClass("dark-theme");
                    $(".mode--toggle").find("img").attr("src", "{{asset('public/assets/landing')}}/img/sun.png");
                }
            }

            $(".nav-toggle").on("click", () => {
                $(".nav-toggle").toggleClass("active");
                $(".menu").toggleClass("active");
                $(".navbar-bottom-wrapper").toggleClass("rounded-0");
            });

            let siteDirection = "{{$siteDirection}}";
            siteDirection = siteDirection === 'rtl';

            // ---- testimonial swiper slider
            var originalSlides = document.querySelectorAll('.testimonial__item').length;
            var swiper = new Swiper(".testimonial-slider", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                coverflowEffect: {
                    rotate: 0,
                    stretch: 0,
                    depth: 100,
                    modifier: 2.5,
                    slideShadows: false
                },
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false
                },
                keyboard: {
                    enabled: true
                },
                mousewheel: {
                    thresholdDelta: 70
                },
                spaceBetween: 30,
                loop: true,
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                },
                on: {
                    init: function () {
                        setEqualHeight();
                        this.autoplay.start();
                        updateCounter(this);
                    },
                    slideChange: function () {
                        updateCounter(this);
                    },
                    resize: function () {
                        setEqualHeight();
                    }
                }
            });

            function setEqualHeight() {
                let maxHeight = 0;
                let slides = document.querySelectorAll('.testimonial__item');

                slides.forEach(function(slide) {
                    slide.style.height = 'auto';
                });

                slides.forEach(function(slide) {
                    if (slide.offsetHeight > maxHeight) {
                        maxHeight = slide.offsetHeight;
                    }
                });

                slides.forEach(function(slide) {
                    slide.style.height = maxHeight + 'px';
                });
            }

            function updateCounter(swiper) {
                var currentIndex = swiper.realIndex + 1;
                var totalSlides = originalSlides;
                document.querySelector('.slider-counter').textContent = currentIndex + ' / ' + totalSlides;
            }

            var sliderElement = document.querySelector('.testimonial-slider');

            sliderElement.addEventListener('mouseenter', function () {
                swiper.autoplay.stop();
            });

            sliderElement.addEventListener('mouseleave', function () {
                swiper.autoplay.start();
            });
            // Navigation buttons
            document.querySelector('.testimonial-owl-prev').addEventListener('click', function () {
                swiper.slidePrev();
            });
            document.querySelector('.testimonial-owl-next').addEventListener('click', function () {
                swiper.slideNext();
            });
            swiper.slideTo(1, false, false);
            // ---- testimonial swiper slider ends


            var app = $(".app-slider")
                .on("initialized.owl.carousel changed.owl.carousel", function (e) {
                    if (!e.namespace) {
                        return;
                    }
                    var carousel = e.relatedTarget;
                    $(".app-counter").text(
                        carousel.relative(carousel.current()) +
                        1 +
                        " / " +
                        carousel.items().length
                    );
                })
                .owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 0,
                    nav: false,
                    mouseDrag: false,
                    touchDrag: false,
                    autoplay: true,
                    autoplayTimeout: 2500,
                    autoplayHoverPause: false,
                    rtl: siteDirection,
                    speed: 1000,
                    autoplaySpeed: 1000,
                    smartSpeed: 1000,
                    fluidSpeed: 1000,
                });
            $(".app-content, .app-thumb").on('mouseenter', function() {
                app.trigger("stop.owl.autoplay");
            });
            $(".app-content, .app-thumb").on('mouseleave', function() {
                app.trigger("play.owl.autoplay", [2500]);
            });
            $(".app-owl-prev").on("click", function () {
                app.trigger("prev.owl.carousel");
                $(".owl-stage").css("transition", "all 0.3s ease 1s !important");
            });
            $(".app-owl-next").on("click", function () {
                app.trigger("next.owl.carousel");
            });

            let owl = $(".service-slider").owlCarousel({
                margin: 0,
                responsiveClass: true,
                nav: false,
                dots: false,
                loop: true,
                rtl: siteDirection,
                autoplay: true,
                autoplayTimeout: 2500,
                smartSpeed: 1000,
                autoplayHoverPause: false,
                mouseDrag: true,
                touchDrag: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    500: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    992: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    },
                },
            });

            $(".service-section").on('mouseenter', function() {
                owl.trigger("stop.owl.autoplay");
            });
            $(".service-section").on('mouseleave', function() {
                owl.trigger("play.owl.autoplay", [2500]);
            });

            /*Slider Trigger*/
            $(".service-slide-prev").on("click", function () {
                owl.trigger("prev.owl.carousel");
            });
            $(".service-slide-next").on("click", function () {
                owl.trigger("next.owl.carousel");
            });

            $(".service-inner-slider").owlCarousel({
                loop: false,
                margin: 0,
                responsiveClass: true,
                nav: false,
                dots: false,
                autoplay: true,
                rtl: siteDirection,
                autoplayTimeout: 1500,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 3,
                        margin: 10,
                    },
                    500: {
                        items: 4,
                        margin: 10,
                    },
                    576: {
                        items: 3,
                        margin: 10,
                    },
                    768: {
                        items: 5,
                        margin: 20,
                    },
                    992: {
                        items: 6,
                        margin: 30,
                    },
                    1200: {
                        items: 6,
                        margin: 40,
                    },
                },
            });
            $("[data-target]").on("click", function () {
                const slide = $(this).data("target");
                $(".service__item-popup").each(function () {
                    if ($(this).data("slide") === slide) {
                        $(this).addClass("active");
                    } else {
                        $(this).removeClass("active");
                    }
                });
            });
            $(".close__popup").on("click", function () {
                $(".service__item-popup").removeClass("active");
            });
        });
    })(jQuery);
</script>

<script>
    // ---- service section active starts
    $(document).ready(function () {
        var $homeMenu = $('a[href="{{route('home')}}"]');
        var $serviceMenu = $('a[href="{{route('home')}}#service"]');
        var $serviceSection = $('.service-section');
        var $bannerSection = $('.banner-section');

        function checkSections() {
            var bannerHeight = $bannerSection.outerHeight();
            var serviceTop = $serviceSection.offset().top - 100;
            var serviceBottom = serviceTop + $serviceSection.outerHeight();
            var scrollTop = $(window).scrollTop();
            var scrollBottom = scrollTop + $(window).height();

            // Home menu active when above service section
            if (scrollTop + bannerHeight < serviceTop) {
                $homeMenu.addClass('active');
                $serviceMenu.removeClass('active');
            }
            // Service menu active when in service section
            else if (scrollTop >= serviceTop && scrollTop < serviceBottom) {
                $homeMenu.removeClass('active');
                $serviceMenu.addClass('active');
            }
            // When past all sections, reset to home active
            else {
                $homeMenu.addClass('active');
                $serviceMenu.removeClass('active');
            }
        }

        $(window).on('scroll', checkSections);
        checkSections();

        if (window.location.pathname !== '/') {
            return;
        }
    });
    // ---- service section active end

    @if ($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    @endif
</script>

</body>
</html>
