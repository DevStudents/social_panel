<div class="panel panel-default">
    <form  method="POST" action="{{url('/comments')}}">
        {{csrf_field()}}
        <div class="panel-body">
            @if ($errors->has('comment_'.$post->id.'_content'))
                <span class="help-block">
                        <strong>{{ $errors->first('comment_'.$post->id.'_content') }}</strong>
                     </span>
            @endif
            <div class="form-group{{ $errors->has('comment_'.$post->id.'_content') ? ' has-error' : '' }}">
                <img class="img-responsive pull-left" style="margin: 10px;" src="{{url('/user-avatar/'.Auth::id().'/60')}}">
                <input class="form-control pull-left" name="{{'comment_'.$post->id.'_content'}}" placeholder="Place for your comment...">
                <input type="hidden" class="form-control pull-left" name="post_id" value="{{$post->id}}"/>
            </div>
            <button type="submit" class="btn btn-primary btn-sm pull-right" >Add comment</button>
        </div>
    </form>
</div>