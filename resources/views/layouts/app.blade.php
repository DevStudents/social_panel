<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">


                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    &nbsp;
                    <!-- Branding Image -->

                    <a class="navbar-brand" href="{{ url('/home') }}">
                        See all...
                    </a>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>



                </div>

                <form method="get" action="{{url('/search')}}" class="form-inline">
                    <input class="form-control" name="q" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-default" type="submit">Search</button>
                </form>


                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->




                    <!-- Right Side Of Navbar -->


                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{url('/users/'.Auth::user()->id.'/edit')}}">Edit profile</a>

                                    </li>
                                    <li>
                                        <a href="{{url('/users/'.Auth::user()->id)}}">My profile</a>

                                    </li>
                                    <li>
                                        <a href="{{url('users/'.Auth::id().'/friends/')}}">
                                                Friends
                                        </a>

                                    </li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    @if(count(Auth::user()->unreadNotifications) > 0)
                                        <b style="color: red">Notifications</b>
                                        <b style="color: red">({{count(Auth::user()->unreadNotifications)}})</b>
                                    @else
                                        Notifications
                                    @endif
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu list-group">
                                    @forelse(Auth::user()->unreadNotifications as $note)
                                        @if($note->data['link'])
                                            <a href="{{url('posts/'.$note->data['post_id'].'#comment_'.$note->data['comment_id'])}}">{{$note->data['message'].':'.$note->data['user_name']}}</a>
                                        @else
                                         <li style="font-size: smaller">
                                         <b>{{$note->data['message'] .' : '}}</b><a href="{{url('/users/'.$note->data['user_id'])}}">{{$note->data['user_name']}}</a>
                                         </li>
                                        @endif
                                    @empty <h5 style="font-size: smaller">Nothing new...</h5>
                                    @endforelse
                                </ul>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
