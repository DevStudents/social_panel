@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        @forelse($all_posts as $post)
          @include('post.single')
        @empty
            <div class="panel panel-default">
                <div class="panel-body">
                    <span> Not even a ONE!!!!</span>
                </div>
            </div>
        @endforelse
    </div>
@endsection