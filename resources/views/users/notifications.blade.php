@extends('layouts.app')
@section('content')

            <div class="container blur-container">
                <div class="col-md-12 notifications">
                    @if(count(Auth::user()->notifications) > 0)
                        <h1>Number of notifications: {{(count(Auth::user()->notifications))}}</h1>
                    @endif
                    @forelse(Auth::user()->notifications as $note)

                        <div class="col-md-3 col-sm-4 col-xs-6  {{$note->read_at ? ' disabled':''}} note">
                            <img src="{{url('/user-avatar/'.$note->data['user_id'].'/100')}}" alt="avatar" class="img-responsive pull-left" style="padding-right: 20px">
                            @if(!empty($note->data['comment_id']))
                                <a href="{{url('posts/'.$note->data['post_id'].'#comment_'.$note->data['comment_id'])}}"><b>{{$note->data['message']}}</b>{{$note->data['user_name']}}</a>
                            @elseif(!empty($note->data['post_id']))
                                <a href="{{url('posts/'.$note->data['post_id'])}}"> <b>{{$note->data['message']}}</b></a><a href="{{url('/users/'.$note->data['user_id'])}}">{{$note->data['user_name']}}</a>
                            @elseif(empty($note->data['comment_id']) && !empty($note->data['post_id']))
                                <a href="{{url('posts/'.$note->data['post_id'])}}"><b>{{$note->data['message']}}</b>{{$note->data['user_name']}}</a>
                            @else
                                <a href="{{url('/users/'.$note->data['user_id'])}}"><b>{{$note->data['message']}}</b>{{$note->data['user_name']}}</a>
                            @endif
                            <form method="post" action="{{url('/notifications/'.$note->id)}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <button type="submit" class="btn btn-primary btn-sm pull-right{{$note->read_at ? ' disabled':''}} " style="margin:10px;">OK</button>
                            </form>
                         </div>

                    @empty
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Nothing new</h1>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>


@endsection