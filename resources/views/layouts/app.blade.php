<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NOICE!</title>

    <!-- Styles -->
    <link href="{{ asset('custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}">
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
                    <a class="navbar-brand"  href="{{ url('/home') }}">
                        WALL
                    </a>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        NOICE!
                    </a>

                </div>




                <div class="collapse navbar-collapse flex-navbar" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->



                    <form method="get" action="{{url('/search')}}" class="form-inline">
                        <input class="form-control" name="q" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-default" type="submit">Search</button>
                    </form>


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
                                        <form method="post" action="{{url('/notifications')}}" style="margin:0px; padding: 0px;">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <button type="submit" class="btn btn-link" style="margin:0px; padding: 0px;">Your notifications
                                                <b style="color: #0c9163;margin:0px; padding: 0px;">({{count(Auth::user()->unreadNotifications)}})</b>
                                            </button>
                                        </form>
                                    @else
                                        Your notifications
                                    @endif
                                    <span class="caret" style="padding: 0px;margin: 0px"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @forelse(Auth::user()->unreadNotifications as $note)
                                         @if(!empty($note->data['comment_id']))
                                            <li><p class="text-justify"><a class="text-justify" href="{{url('posts/'.$note->data['post_id'].'#comment_'.$note->data['comment_id'])}}">{{$note->data['message']}}</a><br><a href="{{url('/users/'.$note->data['user_id'])}}">{{$note->data['user_name']}}</a></p></li>
                                         @elseif(!empty($note->data['post_id']))<p>
                                            <li><p class="text-justify"><a class="text-justify" href="{{url('posts/'.$note->data['post_id'])}}">{{$note->data['message'] }}</a><br><a href="{{url('/users/'.$note->data['user_id'])}}">{{$note->data['user_name']}}</a></p></li>
                                        @elseif(empty($note->data['comment_id']) && !empty($note->data['post_id']))
                                             <li><p class="text-justify"><a href="{{url('posts/'.$note->data['post_id'])}}">{{$note->data['message']}}<br>{{$note->data['user_name']}}</a></p></li>
                                        @else
                                             <li><p class="text-justify"><a  href="{{url('/users/'.$note->data['user_id'])}}">{{$note->data['message']}}<br>{{$note->data['user_name']}}</a></p></li>
                                        @endif

                                    @empty <li><a>Nothing new...</a></li>
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
