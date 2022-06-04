@extends('layouts.web')
@section('title', $title)
@section('content')

<script>
    // var scrollBefore = $('.bn-main').width();
    // function hdScroll() {
    //     var top = $(this).scrollTop();
    //     var hg = $('#banner').height() - $('#other').height();
    //     if (top > hg) {
    //         $('#pl-header').removeClass('hd-bg-trans');
    //     } else {
    //         $('#pl-header').addClass('hd-bg-trans');
    //     }
    // }
    $(document).ready(function () {
        $('#banner').bxSlider({
            minSlides: 2,
            maxSlides: 2,
            slideWidth: 600,
            responsive: true,
            auto: false,
            autoHover: false,
            controls: true,
            autoControls: false,
            stopAutoOnClick: false,
            touchEnabled: false,
            nextText: '<i class="fa fa-lw fa-arrow-right" />',
            prevText: '<i class="fa fa-lw fa-arrow-left" />',
            pager: true,
            speed: 1200,
            infiniteLoop: true,
            // pagerCustom: '.custome-bx-pager',
        });
    });
</script>

<div class="body-block">
	<div class="banner-container">
        <div class="main-container display-flex space-between align-center display-mobile">
            <div class="width width-50 width-mobile">
                <div class="width width-60 width-mobile width-center">
                    <div>
                        <div 
                            class="image image-all image-radius" 
                            style="background-image: url({{ asset('img/sites/logo.png') }})"></div>
                    </div>
                </div>
            </div>
            <div class="width width-50 width-mobile">
                <div class="width width-70 width-mobile width-center">
                    <div>
                        <div style="margin-bottom: 15px;">
                            <h2 class="ctn-font ctn-26pt ctn-white-color ctn-font-primary-semibold">
                                IT Solution and Services <br> #ThinkFuture
                            </h2>
                        </div>
                        <div>
                            <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            We always come up with ideas and innovations to provide solutions in technology for customers.
                            </p>
                        </div>
                        <div class="display-flex">
                            <a href="{{ url('/contacts') }}" 
                                class="btn btn-main-color btn-radius"
                                style="margin-top: 32px;">
                                Contact Us <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($service) != 0)
        <div class="main-container">
            <div class="width width-80 width-center width-mobile">
                <div style="padding: 0 15px;">
                    <h1 
                        class="ctn-font ctn-24pt ctn-min-color ctn-font-primary-semibold ctn-center"
                        style="margin-bottom: 15px;">
                        OUR SERVICES
                    </h1>
                    <p class="ctn-font ctn-14pt ctn-min-color ctn-line ctn-center ctn-font-sekunder-thin">
                        Over the years we have helped many clients building websites, mobile application, and providing IT Support Maintenance.
                    </p>
                </div>
            </div>
            <div class="main-container display-flex left display-mobile">
                @foreach($service as $dt)
                    @include('web.service.card')
                @endforeach
            </div>
            <div class="display-flex center">
                <a href="{{ url('/services') }}" class="btn btn-main-color">
                    MORE SERVICES <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                </a>
            </div>
        </div>
    @endif

    @if (count($galery) != 0)
        <div class="main-container">
            <div class="width width-80 width-center width-mobile">
                <div style="padding: 0 15px;">
                    <h1 
                        class="ctn-font ctn-24pt ctn-min-color ctn-font-primary-semibold ctn-center"
                        style="margin-bottom: 15px;">
                        OUR PORTOFOLIOS
                    </h1>
                    <p class="ctn-font ctn-14pt ctn-min-color ctn-line ctn-center ctn-font-sekunder-thin">
                        We have delivered needs and answered their problems with the solutions we provide. The digital solutions we have made.
                    </p>
                </div>
            </div>
            <div class="main-container">
                <div class="banner" id="banner" style="width: 100%;">
                    @foreach ($galery as $key => $bn)
                        <div class="bn-place">
                            <div class="bn-image image image-hover" style="background-image: url({{ asset('img/galery/covers/'.$bn->cover) }});"></div>
                            @if (!empty($bn->title))
                                <div class="bn-cover bn-bottom">
                                    <div class="bn-info">
                                        <div class="desc">
                                            @if (!empty($bn->title))
                                                <p>
                                                    {{ $bn->title }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="display-flex center">
                <a href="{{ url('/portofolios') }}" class="btn btn-main-color">
                    MORE PORTOFOLIOS <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                </a>
            </div>
        </div>
    @endif

    @if (count($banner) != 0)
        <div class="banner-container">
            <div class="main-container">
                <div class="width width-80 width-center width-mobile">
                    <div style="padding: 0 15px;">
                        <h1 
                            class="ctn-font ctn-24pt ctn-white-color ctn-font-primary-semibold ctn-center"
                            style="margin-bottom: 15px;">
                            OUR PRODUCTS
                        </h1>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-center ctn-font-sekunder-thin">
                            We have delivered needs and answered their problems with the solutions we provide. The digital solutions we have made.
                        </p>
                    </div>
                </div>
                <div class="main-container display-flex left display-mobile">
                    @foreach($banner as $dt)
                        @include('web.banner.card-primary')
                    @endforeach
                </div>
                <div class="display-flex center">
                    <a href="{{ url('/products') }}" class="btn btn-main-color">
                        MORE PRODUCTS <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if (count($note) != 0)
        <div class="main-container">
            <div class="width width-80 width-center width-mobile">
                <div style="padding: 0 15px;">
                    <h2 
                        class="ctn-font ctn-24pt ctn-min-color ctn-font-primary-semibold ctn-center"
                        style="margin-bottom: 15px;">
                        OUR CLIENTS
                    </h2>
                    <p class="ctn-font ctn-14pt ctn-min-color ctn-line ctn-center ctn-font-sekunder-thin">
                        We are very happy to have helped so many companies and built excellent partnerships with them.
                    </p>
                </div>
            </div>
            <div class="main-container display-flex wrap center" style="padding-bottom: 0;">
                @foreach($note as $dt)
                    <div style="padding: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="image image-center" style="height: 60px; background-color: #fff;">
                            <img 
                                class="img" 
                                src="{{ asset('/img/note/thumbnails/'.$dt->cover) }}" 
                                alt="" 
                                style="height: 100%; filter: grayscale(100%);">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (count($testimony) != 0)
        <div class="main-container">
            <div class="width width-80 width-center width-mobile">
                <div style="padding: 0 15px;">
                    <h2 
                        class="ctn-font ctn-24pt ctn-min-color ctn-font-primary-semibold ctn-center"
                        style="margin-bottom: 15px;">
                        GOOD THING CLIENT SAYS
                    </h2>
                    <!-- <p class="ctn-font ctn-14pt ctn-min-color ctn-line ctn-center ctn-font-sekunder-thin">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.
                    </p> -->
                </div>
            </div>
            <div class="main-container-medium display-flex left display-mobile">
                @foreach($testimony as $dt)
                    @include('web.testimonial.card')
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection