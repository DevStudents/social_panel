@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-md-8">
        <div class="panel panel-default">
            @if($user->id == Auth::id())
            <form  method="POST" action="{{url('/posts')}}">
                {{csrf_field()}}
            <div class="panel-body">
                @if ($errors->has('post_content'))
                    <span class="help-block">
                        <strong>{{ $errors->first('post_content') }}</strong>
                     </span>
                @endif
                <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
                    <textarea class="form-control" name="post_content">{{old('post_content')}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary pull-left" >Publish</button>
            </div>
            </form>
            @endif
            </div>    
        </div>
        </div>
    </div>
</div>
@endsection
