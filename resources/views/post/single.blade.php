
<div class="panel panel-default{{$post->trashed() ? ' disabled': ''}}" id="post_{{$post->id}}">
    <div class="panel-body">
         <p class="text-justify created-time"><small class="pull-right">Created at: <a href="{{url('/posts/' .$post->id)}}">{{$post->created_at}}</a></small></p>
        <div class="col-md-12 wrapper">
            <div class="col-md-2">
        <img src="{{url('/user-avatar/'.$post->user->id.'/100')}}" alt="avatar" class="img-responsive pull-left post-avatar" style="padding-right: 20px">
            </div>
            <div class="col-md-10">
                <div class="row">
        <div class="data">

        @if($post->user->id == Auth::id() || admin())
            <div class="btn-group pull-right">
                <button class="btn btn-secondary  dropdown-toggle options" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Options
                </button>
                <div class="dropdown-menu">
            <a href="{{url('/posts/'. $post->id .'/edit')}}" class="pull-left"><button type="submit" class="btn btn-link  pull-right"
             style="margin:10px;">
                    Edit
             </button></a>
            <form method="post" action="{{url('/posts/'.$post->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('Are U sure?')" class="btn btn-link pull-left" style="margin:10px;">Delete</button>
            </form>
                </div>
            </div>
        @endif

        @include('post.likes')
         <h5 class="name-post pull-left"><a href="{{url('/users/' .$post->user->id)}}">{{$post->user->name}}</a></h5>

        </div>
                </div>
                <div class="row">
        <div class="text-post">
        <article>{{$post->post_content}}</article>
        </div>
                </div>
        </div>
        </div>


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
