@extends('layouts.app')
@section('content')
    <div class="blur-container">
    <div id="comment_{{$comment->id}}" class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="{{url('/comments/'. $comment->id)}}">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    @if ($errors->has('comment_content'))
                        <span class="help-block">
                             <strong>{{ $errors->first('comment_content') }}</strong>
                        </span>
                    @endif
                    <div class="form-group{{ $errors->has('comment_content') ? ' has-error' : '' }}">
                        <textarea class="form-control" name="comment_content">{{$comment->content}}</textarea>
                    </div>
                    <button type="submit" class="button-add-comment btn-sm pull-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
