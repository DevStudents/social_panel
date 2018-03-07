@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-md-8">

            @if($user->id == Auth::id())
            @include('post.form')
            @endif

            @forelse($posts as $post)
                @include('post.single')
            @empty
                    <div class="panel panel-default" style="padding: 10px 10px;">
                        <h2>This user has no posts yet :(</h2>
                    </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
