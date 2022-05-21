<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--css-->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('icons/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('scss/app.css') }}" />

    <!--js-->
    <script src="{{ asset('js/jquery.js') }}"></script>

</head>
<body>
    <div class="frm-sign">
        <div class="fs-top">
            <a href="{{ url('/') }}">
                <img 
                    src="{{ asset('img/sites/logo.png') }}" 
                    alt="Kebun Begonia Glory"
                    class="logo"
                    style="width: 200px; margin: auto;">
            </a>
        </div>
        <div class="fs-mid">

            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                @if(session()->has('login_error'))
                <div class="fs-text">
                    <div class="alert alert-success">
                        {{ session()->get('login_error') }}
                    </div>
                </div>
                @endif

                <div class="fs-block">
                    <div class="fs-left">
                        <div class="icn fa fa-lg fa-user"></div>
                    </div>
                    <div class="fs-right">
                        <input 
                            type="text" 
                            name="identity" 
                            id="identity" 
                            class="txt txt-main-color"
                            placeholder="Username or Password"
                            value="{{ old('identity') }}"
                            required="required">
                    </div>
                </div>
                @if ($errors->has('identity'))
                <div class="padding-top-10px">
                    <div class="alert alert-error">
                        {{ $errors->first('identity') }}
                    </div>
                </div>
                @endif

                <div class="padding-10px"></div>

                <div class="fs-block">
                    <div class="fs-left">
                        <div class="icn fa fa-lg fa-key"></div>
                    </div>
                    <div class="fs-right">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="txt txt-main-color"
                            required="required"
                            placeholder="Password">
                    </div>
                </div>
                @if ($errors->has('password'))
                <div class="padding-top-10px">
                    <div class="alert alert-error">
                        {{ $errors->first('password') }}
                    </div>
                </div>
                @endif

                <div class="padding-20px">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        {{ old('remember') ? 'checked' : '' }}
                        class="">
                    <span style="font-size: 11pt">Remember Me</span>
                </div>

                <div class="padding-10px"></div>

                <div class="fs-button">
                    <input type="submit" value="Login" class="btn btn-main-color btn-full">
                </div>

            </form>

        </div>
    </div>
</body>
</html>