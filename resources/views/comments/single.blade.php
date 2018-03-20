<div id="comment_{{$comment->id}}" class="wrapper" style="padding-right: 100px; margin: 10px; border-top: 1px solid #58b875; {{$comment->trashed() ? 'opacity:0.4;': ''}}">
    @if($comment->user_id == Auth::id() || admin())
        <div class="my_panel">
            <a href="{{url('/comments/'. $comment->id .'/edit')}}" class="pull-right"><button type="submit" class="btn btn-success btn-sm pull-right"
                                                                                              style="margin:10px;">
                    Edit
                </button></a>
            <form method="post" action="{{url('/comments/'.$comment->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('Are U sure?')" class="btn btn-danger btn-sm pull-right" style="margin:10px;">Delete</button>
            </form>
        </div>
    @endif
   @include('comments.likes')
    <img class="img-fluid pull-left" style="border-left: 1px solid #58b875; margin-right: 5px;"  src="{{url('/user-avatar/'.$comment->user_id.'/52')}}">
    <a style="margin-left: 5px;" class="pull-left" href="{{url('/users/'.$comment->user_id)}}">{{$comment->user->name}} </a><br>
    <p class="text-justify"   class="pull-left" >{{$comment->content}}</p>

</div>