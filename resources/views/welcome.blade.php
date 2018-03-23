<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{asset('custom.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->

    </head>
    <style>
        body {
        //background:linear-gradient( 45deg,rgba(162, 230, 27, 0.71), rgba(147, 194, 48, 0.47));
            background-image: url('bg.jpeg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100%;
            width: 100%;
            margin: 0;
        }
    </style>
    <body>
    <div class="blur">
        <div class="flex-center position-ref full-height">

        <div class="skewedBox">
            <div class="content">
                <div class="title m-b-md">
                    NOICE!
                    <div class="links">
                        @if (Route::has('login'))
                            @auth
                           <a href="{{ url('/home') }}">Home </a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </body>
</html>
