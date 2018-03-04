@extends('layouts.app')
@section('content')

        <div class="container">
            <div class="col-md-12" style="text-align: center;">
                @if(count($list_user) > 0)
                    <h1>Number of friends: {{(count($list_user))}}</h1>
                @endif
                @forelse($list_user as $user)
                    <div class="col-md-3 col-sm-4 col-xs-6" style="align-items: center;">
                        <img class="img-responsive" src="{{url('/user-avatar/'.($user->friend_id == $id? $user->user_id : $user->friend_id)
                        .'/250')}}" alt="User avatar">
                        <a href="{{url('/users/'.($user->friend_id == $id ? $user->user_id : $user->friend_id))}}">
                            {{ user($user->friend_id == $id? $user->user_id : $user->friend_id)[0]->name}}
                        </a>
                    </div>
                @empty

                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <h1>This user don't have any friends</h1>
                        </div>
                    </div>
                @endforelse
            </div>
            {{ $list_user->links() }}
        </div>




@endsection