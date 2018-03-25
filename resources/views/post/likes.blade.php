@if(Auth::check() && Auth::user()->like->contains('post_id',$post->id))
    <form method="post" action="{{url('/like')}}">
        {{csrf_field()}}
        {{method_field('delete')}}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <button type="submit" class="btn btn-primary-post pull-right" style="margin:10px;">
            {{$post->like->count()}} noice!</button>
    </form>
@elseif(Auth::check())
    <form method="post" action="{{url('/like')}}">
        {{csrf_field()}}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <button type="submit" class="btn btn-primary-post pull-right" style="margin:10px;">
            @if($post->like->count() > 0)
            {{$post->like->count()}}
            @endif
            Noice!</button>

    </form>
@endif