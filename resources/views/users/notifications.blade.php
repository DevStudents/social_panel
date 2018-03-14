@extends('layouts.app')
@section('content')

            <div class="container">
                <div class="col-md-12" style="text-align: center;">
                    @if(count(Auth::user()->notifications) > 0)
                        <h1>Number of notifications: {{(count(Auth::user()->notifications))}}</h1>
                    @endif
                    @forelse(Auth::user()->notifications as $note)
                        <div class="col-md-3 col-sm-4 col-xs-6" style="align-items: center;">
                            <a>
                                {{$note->data['data']}}
                            </a>
                        </div>
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