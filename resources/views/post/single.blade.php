
<div class="panel panel-default">
    <div class="panel-body">
        <div class="wrapper" style="padding-right: 100px;padding-bottom: 30px;">
        <img src="{{url('/user-avatar/'.$post->user->id.'/80')}}" alt="avatar" class="img-responsive pull-left" style="padding-right: 20px">
         <span><a href="{{url('/users/' .$post->user->id)}}">{{$post->user->name}}</a></span>
         <small class="pull-right">Created at: <a href="{{url('/posts/' .$post->id)}}">{{$post->created_at}}</a></small><br>
        <div style="margin-top: 10px;">{{$post->post_content}}</div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm pull-left" style="margin:10px;">Noice!</button>
        @if($post->user->id == Auth::id())
            <a href="{{url('/posts/'. $post->id .'/edit')}}" class="pull-right"><button type="submit" class="btn btn-success btn-sm pull-right"
             style="margin:10px;">
                    Edit
             </button></a>
            <form method="post" action="{{url('/posts/'.$post->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('Are U sure?')" class="btn btn-danger btn-sm pull-right" style="margin:10px;">Delete</button>
            </form>
        @endif



    </div>
    <div class="panel-body">
        @if(Auth::check())
            @include('comments.form')
        @endif
    </div>


    @forelse($post->comment as $comment)
            <div class="wrapper" style="padding-right: 100px;padding-bottom: 30px; margin: 20px; border-bottom: 1px solid darkseagreen">
                <img class="img-responsive pull-left" src="{{url('/user-avatar/'.$comment->user_id.'/50')}}">
                <a style="margin-left: 5px;" class="pull-left" href="{{url('/users/'.$comment->user_id)}}">{{$comment->user->name}} </a><br>
                <span style="margin-left: 5px;" class="pull-left" >{{$comment->content}}</span>
            </div>
    @empty <h5 style="font-size: smaller">This post has no comments</h5>
    @endforelse
</div>
