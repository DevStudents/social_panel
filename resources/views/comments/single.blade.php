<div id="comment_{{$comment->id}}" class="wrapper-comment {{$comment->trashed() ? 'disabled': ''}}">
    @if($comment->user_id == Auth::id() || admin())
        <div class="btn-group pull-right">
            <button class="btn btn-secondary btn-sm dropdown-toggle options" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Options
            </button>
            <div class="dropdown-menu">
                <form method="post" action="{{url('/comments/'.$comment->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Are U sure?')" class="btn btn-link">Delete</button>
                </form>
                <a href="{{url('/comments/'. $comment->id .'/edit')}}">
                    <button class="btn btn-link">
                        Edit
                    </button>
                </a>
            </div>
        </div>

    @endif

    @include('comments.likes')

    <img class="img-fluid pull-left comment-avatar"  src="{{url('/user-avatar/'.$comment->user_id.'/60')}}">
            <p class="text-justify name"><a class="pull-left" href="{{url('/users/'.$comment->user_id)}}">{{$comment->user->name}}</a></p><br>
            <p class="text-justify">{{$comment->content}}</p>

</div>