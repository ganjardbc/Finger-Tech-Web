<!DOCTYPE html>
<html>
<head>
    <title>Pengelolaan Konten</title>
    
    <!--meta-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/img/sites/icon.png') }}">

    <!--css-->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('icons/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('scss/app.css') }}" />
    

    <!--js-->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        function goBack() {
            window.history.back();
        }

        function loadPopup(stt) {
            if (stt == 'show') {
                $('#load-popup').show();
            } else {
                $('#load-popup').hide();
            }
        }

        function changSide() 
        {
            var ic = $('#side-icn');
            var bt = $('#side-btn');
            var pl = $('#dashboard');
            var tr = pl.attr('class');
            if (tr == 'dashboard') 
            {
                pl.addClass('maximal');
                bt.attr('class', 'btn btn-main-color');
                //ic.attr('class', 'fa fa-lg fa-arrow-right');
            } 
            else 
            {
                pl.removeClass('maximal');
                bt.attr('class', 'btn btn-grey2-main-color');
                //ic.attr('class', 'fa fa-lg fa-bars');
            }
        }

        $(function () 
        { 
            var imagesPreview = function (input, place) {
                if (input.files) {

                    var reader = new FileReader();	
                    reader.onload = function (event) {
                        $('#add-pict')
                        .css('background-image', 'url('+event.target.result+')');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            };
            $('#cover').on('change', function () {
                imagesPreview(this, '#add-pict');
            });
        });

        $(document).ready(function () 
        {
            var path = '{{ $path }}';
            //$('.s-menu a').removeClass('active');
            $('#'+path).addClass('active');

            $('#description').keyup(function(event) {
                var length = $(this).val().length;
                $('#display_count').html(length);
                
            });
        });
    </script>

</head>
<body>
    <div class="dashboard" id="dashboard">
        <div class="side">
            <div class="padding-top-10px">
                <div class="s-block">
                    <ul class="s-menu">
                        <li>
                            <div class="icn">
                                <button 
                                    class="btn btn-grey2-main-color"
                                    style="
                                        border-radius: 0;
                                        border-top-right-radius: 45px;
                                        border-bottom-right-radius: 45px;
                                    " 
                                    id="side-btn"
                                    onclick="changSide()">
                                    <span class="fa fa-lg fa-bars" id="side-icn"></span>
                                </button>
                            </div>
                            <div class="txt">
                                <h1 class="ctn-font ctn-22pt ctn-font-primary-bold ctn-min-color">Menu</h1>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="s-devide"></div>

            <div class="s-block">
                <ul class="s-menu">
                    <a href="{{ url('/admin') }}" id="home">
                        <li>
                            <div class="icn fa fa-lg fa-home"></div>
                            <div class="txt">
                                <div>Halaman Utama</div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
            
            <div class="s-devide"></div>

            <div class="s-block">
                <ul class="s-menu">
                    <a href="{{ url('/admin/product') }}" id="banner">
                        <li>
                            <div class="icn fa fa-lg fa-camera"></div>
                            <div class="txt">
                                <div>Produk</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/service') }}" id="service">
                        <li>
                            <div class="icn fa fa-lg fa-lightbulb"></div>
                            <div class="txt">
                                <div>Konten & Layanan</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/portofolio') }}" id="galery">
                        <li>
                            <div class="icn fa fa-lg fa-images"></div>
                            <div class="txt">
                                <div>Portofolio</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/article') }}" id="article">
                        <li>
                            <div class="icn fa fa-lg fa-edit"></div>
                            <div class="txt">
                                <div>Artikel & Blog</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/client') }}" id="note">
                        <li>
                            <div class="icn far fa-lg fa-sticky-note"></div>
                            <div class="txt">
                                <div>Klien</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/testimony') }}" id="testimony">
                        <li>
                            <div class="icn fa fa-lg fa-quote-left"></div>
                            <div class="txt">
                                <div>Testimonial</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/contact') }}" id="contact">
                        <li>
                            <div class="icn fa fa-lg fa-id-card"></div>
                            <div class="txt">
                                <div>Kontak Pelanggan</div>
                            </div>
                        </li>
                    </a>
                    <a href="{{ url('/admin/admin') }}" id="admin">
                        <li>
                            <div class="icn fa fa-lg fa-users"></div>
                            <div class="txt">
                                <div>Pengelolaan Admin</div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>

            <div class="s-devide"></div>

            <div class="s-block">
                <ul class="s-menu">
                    <a href="{{ url('/admin/admin/edit') }}" id="edit">
                        <li>
                            <div class="icn fa fa-lg fa-cog"></div>
                            <div class="txt">
                                <div>Akun Admin</div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>

            <div class="s-devide"></div>

            <div class="s-block">
                <ul class="s-menu">
                    <a 
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <li>
                            <div class="icn fa fa-lg fa-power-off"></div>
                            <div class="txt">
                                <div>Logout</div>
                            </div>
                        </li>
                    </a>
                    <form 
                        id="logout-form" 
                        action="{{ route('logout') }}" 
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>

        </div>
        <div class="content">
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
                            <div>Sedang memproses...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>