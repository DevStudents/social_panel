
    <form  method="POST" action="{{url('/comments')}}">
        {{csrf_field()}}
            @if ($errors->has('comment_'.$post->id.'_content'))
                <span class="help-block">
                        <strong>{{ $errors->first('comment_'.$post->id.'_content') }}</strong>
                     </span>
            @endif
            <div class="form-group{{ $errors->has('comment_'.$post->id.'_content') ? ' has-error' : '' }} comment-form">
                <img class="img-responsive pull-left comment-img"  src="{{url('/user-avatar/'.Auth::id().'/65')}}">
                <textarea class="form-control pull-left" name="{{'comment_'.$post->id.'_content'}}"></textarea>
                <input type="hidden" class="form-control pull-left" name="post_id" value="{{$post->id}}"/>
            <button type="submit" class="button-add-comment btn-sm pull-right" >Add comment</button>
            </div>
    </form>
