@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <form  method="POST" action="{{url('/posts/'.$post->id)}}">
            {{csrf_field()}}
            {{method_field('PATCH')}}
                    @if ($errors->has('post_content'))
                        <span class="help-block">
                             <strong>{{ $errors->first('post_content') }}</strong>
                        </span>
                    @endif
                    <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
                        <textarea class="form-control" value="{{$post->post_content }}" name="post_content">{{$post->post_content }}</textarea>
                    </div>
                <button type="submit" class="btn btn-success btn-sm pull-right">Save changes</button>
            </form>
        </div>
    </div>
</div>
    @endsection