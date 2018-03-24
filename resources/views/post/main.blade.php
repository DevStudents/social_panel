@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
    <div class="col-md-8 col-md-offset-2">
        @if(Auth::check())
            @include('post.form')
        @endif
        @forelse($posts as $post)
          @include('post.single')
        @empty
            <div class="panel panel-default">
                <div class="panel-body">
                    <span> Not even a ONE!!!!</span>
                </div>
            </div>
        @endforelse
            {{ $posts->links() }}
        </div>
            <button class="fixed-btn">^</button>
        </div>
    </div>
    <script>


        window.addEventListener('scroll',function () {
            if(window.pageYOffset > 700){
            document.querySelector('.fixed-btn').style.display='block';
            }
            else{
                document.querySelector('.fixed-btn').style.display='none';
            }
        });


        var userScroll = false;
        window.addEventListener('wheel',function () {
            userScroll = true;
            setTimeout(function () {
            userScroll = false;
            },1000/61);
        });

        window.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.fixed-btn').addEventListener('click',function () {
               var postSroll = setInterval(function () {
               window.scrollBy(0,((window.pageYOffset/20)*-1)-10);
               if(window.pageYOffset === 0 || userScroll){
               clearInterval(postSroll);
               }
               },1000/60);
            });
        })


    </script>
@endsection