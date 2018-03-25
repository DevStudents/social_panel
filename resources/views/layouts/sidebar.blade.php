<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Profile
            @if($user->id === Auth::id() )
                <a href="{{url('/users/'. $user->id .'/edit')}}" class="pull-right">Edit</a>
            @endif
        </div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <img src="{{url('/user-avatar/'.$user->id.'/330')}}" alt="avatar" class="img-responsive">
            <h2><a href="{{url('/users/' .$user->id)}}">{{$user->name}}</a></h2>
            @if($user->sex == 'm')
                <p>  Male </p>
            @elseif($user->sex == 'f')
                <p> Female </p>
            @endif



            <p>  {{$user->email}} </p>
                    <a href="{{url('users/'.$user->id.'/friends')}}"><button class="btn btn-primary">Friends: {{count($user->friends())}}</button></a>
            @if(Auth::check() && $user->id !== Auth::id())
                @switch(friendship($user->id))
                    @case(1)
                    <form method="post" action="{{url('/friends/'.$user->id)}}">
                        {{csrf_field()}}
                        <button class="btn btn-primary">+ Add to friends</button>
                    </form>
                    @break
                    @case(2)
                        @if(to_accept($user->id) == 1)
                        <button class="disabled btn btn-secondary">Sent</button>
                        @elseif((to_accept($user->id) == 2))
                            <h4 class="text-center">This user sent you a friend request</h4>
                        <form method="post" action="{{url('/friends/'.$user->id)}}">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <button type="submit" class="btn btn-success pull-left">Accept</button>
                        </form>
                        <form method="post" action="{{url('/friends/'.$user->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger pull-right">Reject</button>
                        </form>
                        @endif
                    @break
                    @case(3)
                    <form method="post" action="{{url('/friends/'.$user->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Remove friend</button>
                    </form>
                    @break
                    @default
                    @endswitch

            @endif
        </div>
    </div>
</div>