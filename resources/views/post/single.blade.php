
<div class="panel panel-default">
    <div class="panel-body">
        <img src="{{url('/user-avatar/'.$post->user->id.'/80')}}" alt="avatar" class="img-responsive pull-left" style="padding-right: 25px">
        <div class="pull-left">
        <span><a href="{{url('/users/' .$post->user->id)}}">{{$post->user->name}}</a></span><br>
        <h5>{{$post->post_content}}</h5>
        </div>
        <small class="pull-right">Created at: <a href="{{url('/posts/' .$post->id)}}">{{$post->created_at}}</a></small><br>
        @if($post->user->id == Auth::id())
            <a href="{{url('/posts/'. $post->id .'/edit')}}" class="pull-right"><button type="submit" class="btn btn-success btn-sm pull-right">
                    Edit</button></a>
            <form method="post" action="{{url('/post/'.$post->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger btn-sm pull-right">Delete</button>
            </form>
        @endif
    </div>
</div>