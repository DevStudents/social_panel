<div id="comment_{{$comment->id}}" class="wrapper" style="padding-right: 100px;padding-bottom: 30px; margin: 20px; border-bottom: 1px solid darkseagreen">
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
    <img class="img-responsive pull-left" src="{{url('/user-avatar/'.$comment->user_id.'/50')}}">
    <a style="margin-left: 5px;" class="pull-left" href="{{url('/users/'.$comment->user_id)}}">{{$comment->user->name}} </a><br>
    <span style="margin-left: 5px;" class="pull-left" >{{$comment->content}}</span>
</div>