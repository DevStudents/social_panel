@extends('layouts.app')
@section('content')
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
@endsection