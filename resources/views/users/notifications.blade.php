@extends('layouts.app')
@section('content')

            <div class="container">
                <div class="col-md-12" style="text-align: center;">
                    @if(count(Auth::user()->notifications) > 0)
                        <h1>Number of notifications: {{(count(Auth::user()->notifications))}}</h1>
                    @endif
                    @forelse(Auth::user()->notifications as $note)
                        @if($note->read_at)
                        <div class="col-md-3 col-sm-4 col-xs-6" style="align-items: center; opacity: 0.5;">
                                <b>{{$note->data['message'] .' : '}}</b>
                            <a href="{{url('/users/'.$note->data['user_id'])}}">
                                    {{$note->data['user_name']}}
                                <img class="img-responsive" src="{{url('/user-avatar/'.$note->data['user_id'].'/250')}}" alt="User avatar">
                             </a>
                        </div>
                        @else
                        <div class="col-md-3 col-sm-4 col-xs-6" style="align-items: center;">
                              <a href="{{url('/users/'.$note->data['user_id'])}}">
                                  <img class="img-responsive" src="{{url('/user-avatar/'.$note->data['user_id'].'/250')}}" alt="User avatar">
                                  <b>{{$note->data['message'] .' : '.$note->data['user_name']}}</b>
                              </a>
                            <form method="post" action="{{url('/notifications/'.$note->id)}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <button type="submit" class="btn btn-primary btn-sm pull-right" style="margin:10px;">OK</button>
                            </form>
                         </div>
                        @endif
                    @empty
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <h1>Nothing new</h1>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>


@endsection