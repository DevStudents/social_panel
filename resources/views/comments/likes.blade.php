@if(Auth::check() && Auth::user()->like->contains('comment_id',$comment->id))
    <form method="post" action="{{url('/like')}}">
        {{csrf_field()}}
        {{method_field('delete')}}
        <input type="hidden" name="comment_id" value="{{$comment->id}}">

        <button type="submit" class="btn btn-secondary btn-sm button-like pull-right">{{$comment->like->count()}} Noice!</button>
    </form>
@elseif(Auth::check())
    <form method="post" action="{{url('/like')}}">
        {{csrf_field()}}
        <input type="hidden" name="comment_id" value="{{$comment->id}}">

        <button type="submit" class="btn btn-secondary btn-sm button-like pull-right">
            @if($comment->like->count() > 0)
            {{$comment->like->count()}}
            @endif
            Noice!</button>
    </form>
@endif