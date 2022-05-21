<?php 
    use Adventrest\ServiceModel; 
    use Adventrest\BannerModel; 
?>
<?php
    if (isset($path)) {
        $nowPath = '#'.$path;
    } else {
        $nowPath = '';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    
    <!--meta-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google-site-verification" content="7gjYBIjkR1XNmK_TnKMlOb37ukFqbMSPlBA8r_wHHD4" />

    <meta name = "format-detection" content = "telephone=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="generator" content="" />
    <meta name="robots" content="index,follow" />

    <link rel="shortcut icon" href="{{ asset('/img/sites/icon.png') }}">

    <!--css-->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('icons/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('scss/app.css') }}" />

    <!--js-->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.bxslider.min.js') }}"></script> 

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        function showSubMenu(nav) {
            var tr = $('#'+nav).attr('class');
            if (tr == 'sb-menu') {
                $('#'+nav).addClass('sb-open');
                //$('#'+nav).hide();
                //$('#'+nav).css('display', 'hide');
            } else {
                $('#'+nav).removeClass('sb-open');
                //$('#'+nav).show();
                //$('#'+nav).css('display', 'block');
            }
        }
        function opBar(stt) {  
            if (stt == 'show') {
                //$('#opBar').animate({right: 0}, 500);
                $('#opBar').addClass('pl-active');
            } else {
                //$('#opBar').animate({right: -350}, 500);
                $('#opBar').removeClass('pl-active');
            }
        }
        function toLeft(path) {
			var wd = $('#'+path).width();
			var sc = $('#'+path).scrollLeft();
			if (sc >= 0) {
				$('#'+path).animate({scrollLeft: (sc - wd)}, 500);
			}
		}
		function toRight(path) {
			var wd = $('#'+path).width();
			var sc = $('#'+path).scrollLeft();
			if (true) {
				$('#'+path).animate({scrollLeft: (sc + wd)}, 500);
			}
		}
        function loadPopup(stt) {
            if (stt == 'show') {
                $('#load-popup').show();
            } else {
                $('#load-popup').hide();
            }
        }
        $(document).ready(function () {
            $('#toTop').on('click', function () {
                $('body, html').animate({scrollTop: 0}, 500);
            });

            $('{{ $nowPath }}').addClass('active');
            
            $(window).scroll(function(event) {
                var top = $(this).scrollTop();
                var hg = 60;
                if (top > hg) {
                    $('#plToTop').fadeIn();
                } else {
                    $('#plToTop').fadeOut();
                }
            });
        });
    </script>

</head>
<body>
    <div class="header">
        <div class="place hd-bg-trans" id="pl-header">
            <div class="menu display-flex space-between">
                
                <div class="col col-1">
                    <div class="pl-logo">
                        <a href="{{ url('/') }}">
                            <img 
                                src="{{ asset('img/sites/logo-vertical.png') }}" 
                                class="logo">
                        </a>
                    </div>
                </div>

                <div class="col col-2">
                    <div class="pl-bar">
                        <ul class="mn-menu">
                            <li class="mn-list mn-bar" id="bar" onclick="opBar('show')">
                                <span class="fa fa-lg fa-bars"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="pl-menu" id="opBar">
                        <ul class="mn-menu nav">
                            <li class="mn-list mn-close">
                                <span class="icn fa fa-lg fa-times" onclick="opBar('hide')"></span>
                            </li>
                        </ul>

                        <ul class="mn-menu">
                            <li class="mn-list" id="home">
                                <a class="mn-link" href="{{ url('/') }}">
                                    Home
                                </a>
                            </li>
                            <li class="mn-list" id="about-us">
                                <a class="mn-link" href="{{ url('/profile') }}">
                                    Profile
                                </a>
                            </li>
                            <li class="mn-list" id="service">
                                <a class="mn-link" href="javascript:void(0)" onclick="showSubMenu('head-service')">
                                    <span>Services</span>
                                    <span class="mn-icn fa fa-lg fa-angle-down"></span>
                                </a>
                                <ul class="sb-menu" id="head-service">
                                    @foreach (ServiceModel::AllService(4) as $dt)
                                        <a href="{{ url('/service/'.base64_encode($dt->idservice)) }}" class="sb-list">
                                            <div class="sb-link">
                                                <div class="icn">
                                                    <div 
                                                        class="image image-30px"
                                                        style="background-image: url({{ asset('/img/service/thumbnails/'.$dt->cover) }});"
                                                        ></div>
                                                </div>
                                                <div class="ttl">{{ $dt->title }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <div style="padding: 10px 15px;">
                                        <a href="{{ url('/services') }}" class="btn btn-small btn-main-reverse-color">
                                            More Services <i class="icn icn-right fa fa-lw fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </ul>
                            </li>
                            <li class="mn-list" id="product">
                                <a class="mn-link" href="javascript:void(0)" onclick="showSubMenu('head-product')">
                                    <span>Products</span>
                                    <span class="mn-icn fa fa-lg fa-angle-down"></span>
                                </a>
                                <ul class="sb-menu" id="head-product">
                                    @foreach (BannerModel::AllBanner(4, 'desc') as $dt)
                                        <a href="{{ url('/product/'.base64_encode($dt->idbanner)) }}" class="sb-list">
                                            <div class="sb-link">
                                                <div class="icn">
                                                    <div 
                                                        class="image image-30px"
                                                        style="background-image: url({{ asset('/img/banner/thumbnails/'.$dt->cover) }});"
                                                        ></div>
                                                </div>
                                                <div class="ttl">{{ $dt->title }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <div style="padding: 10px 15px;">
                                        <a href="{{ url('/products') }}" class="btn btn-small btn-main-reverse-color">
                                            More Products <i class="icn icn-right fa fa-lw fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </ul>
                            </li>
                            <li class="mn-list" id="portofolio">
                                <a class="mn-link" href="{{ url('/portofolios') }}">
                                    Portofolios
                                </a>
                            </li>
                            <li class="mn-list" id="article">
                                <a class="mn-link" href="{{ url('/articles') }}">
                                    Articles
                                </a>
                            </li>
                            <li class="mn-list" id="contacts">
                                <a class="mn-link" href="{{ url('/contacts') }}">
                                    Contacts
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="pin" id="plToTop" style="display: none;">
        <div class="ctn" id="toTop">
            <div class="icn fa fa-lg fa-arrow-up"></div>
        </div>
    </div>

    @include('web.main.map-popup')
    @include('web.main.search-popup')
    @include('web.main.image-popup')

    <div class="body">
        @yield('content')
    </div>

    <div class="frm-popup" id="load-popup">
        <div class="fp-place">
            <div class="fp-mid">
                <div class="load">
                    <div class="col-1">
                        <div class="icn fa fa-lg fa-spinner fa-spin"></div>
                    </div>
                    <div class="col-2">
                        <div>Please wait...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="banner-container">
        <div class="main-container footer">
            <div class="padding-10px"></div>
            <div class="place">
                <div class="width width-40 width-mobile">
                    <div style="margin-bottom: 30px;">
                        <div class="pl-logo">
                            <a href="{{ url('/') }}">
                                <img 
                                    src="{{ asset('img/sites/logo-vertical.png') }}" 
                                    class="logo">
                            </a>
                        </div>
                        <h2 class="ctn-font ctn-12pt ctn-white-color ctn-font-primary-semibold" style="margin: 15px 0;">
                            PT. Finger Tech
                        </h2>
                        <p class="ctn-font ctn-12pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            Is a Software house and Digital Marketing <br />
                            Company, With professional competent <br />
                            young expert and experienced.
                        </p> 
                    </div>
                </div>
                <div class="width width-30 width-mobile">
                    <div class="title">
                        <h3 class="ctn-font ctn-12pt ctn-white-color ctn-font-primary-semibold">
                            Our Contacts
                        </h3>
                    </div>
                    <ul class="footer-menu">
                        <li>
                            <div class="icn fa fa-lw fa-phone" style="color: #fff;"></div>
                            <div class="ttl" style="color: #fff;">022 2788-527</div>
                        </li>
                        <li>
                            <div class="icn fa fa-lw fa-phone" style="color: #fff;"></div>
                            <div class="ttl" style="color: #fff;">081-2220-0202</div>
                        </li>
                        <li>
                            <a href="mailto:admin@adventrest.com">
                                <div class="icn fa fa-lw fa-envelope" style="color: #fff;"></div>
                                <div class="ttl" style="color: #fff;">
                                    admin@adventrest.com
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/adventrest/" target="_blank">
                                <div class="icn fab fa-lg fa-instagram" style="color: #fff;"></div>
                                <div class="ttl" style="color: #fff;">Instagram</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/pages/Kebun-Begonia-Lembang/710603522325762" target="_blank">
                                <div class="icn fab fa-lg fa-facebook" style="color: #fff;"></div>
                                <div class="ttl" style="color: #fff;">Facebook</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="width width-30 width-mobile">
                    <div style="margin-bottom: 30px;">
                        <div class="map" id="map" style="margin-bottom: 15px;">
                            <div 
                                class="image image-full image-radius"
                                style="
                                    background-image: url( {{ asset('/img/content/map.png') }});
                                    cursor: pointer;
                                "
                                onclick="opMap('show')"
                            ></div>
                        </div>
                        <div class="ctn-font ctn-12pt ctn-white-color ctn-line ctn-center ctn-font-sekunder-thin">
                            Jl. Batununggal Indah Raya No. 199, <br />
                            Kel. Batununggal, Kec. Bandung Kidul, <br />
                            Kota Bandung, Jawa Barat 40267. <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="display-flex center">
            <div class="ctn-font ctn-white-color ctn-12pt ctn-center ctn-font-sekunder-thin">
                Designed and powered by
                <b class="ctn-font ctn-12pt ctn-font-sekunder-semibold">Finger Tech</b> --
                All Rights Reserved |
                <span class="fa fa-1x fa-copyright"></span>
                2022
                {{ config('app.name') }}
            </div>
        </div>
    </div>

</body>
</html>