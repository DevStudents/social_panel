@if(Auth::check() && Auth::user()->like->contains('comment_id',$comment->id))
    <form method="post" action="{{url('/like')}}">
        {{csrf_field()}}
        {{method_field('delete')}}
        <input type="hidden" name="comment_id" value="{{$comment->id}}">

        <button type="submit" class="btn btn-primary btn-sm pull-right" style="margin:10px;">{{$comment->like->count()}} Not noice!</button>
    </form>
@elseif(Auth::check())
    <form method="post" action="{{url('/like')}}">
        {{csrf_field()}}
        <input type="hidden" name="comment_id" value="{{$comment->id}}">

        <button type="submit" class="btn btn-primary btn-sm pull-right" style="margin:10px;">{{$comment->like->count()}} Noice!</button>
    </form>
@endif