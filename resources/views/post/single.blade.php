
<div class="panel panel-default{{$post->trashed() ? ' disabled': ''}}" id="post_{{$post->id}}">
    <div class="panel-body">
         <p class="text-justify created-time"><small class="pull-right">Created at: <a href="{{url('/posts/' .$post->id)}}">{{$post->created_at}}</a></small></p>
        <div class="wrapper">
            <div class="avatar">
        <img src="{{url('/user-avatar/'.$post->user->id.'/100')}}" alt="avatar" class="img-responsive pull-left" style="padding-right: 20px">
        <div class="data">
         <p class="text-justify name-post"><span><a href="{{url('/users/' .$post->user->id)}}">{{$post->user->name}}</a></span></p>

        </div>
            </div><br>

        <p class="text-justify" >{{$post->post_content}}</p>
        </div>

        @if($post->user->id == Auth::id() || admin())
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

        @include('post.likes')



    </div>
    <div class="panel-body">
        @if(Auth::check())
            @include('comments.form')
        @endif
    </div>


    @forelse($post->comment as $comment)
           @include('comments.single')
    @empty
        <div class="wrapper" style="padding-right: 100px;padding-bottom: 30px; margin: 20px; border-bottom: 1px solid darkseagreen">
            <h5 style="font-size: smaller">This post has no comments</h5>
        </div>
    @endforelse
</div>
