@extends('layouts.app')
@section('content')

        <div class="row">
            <div class="container">
            <div class="col-md-12" style="text-align: center;">
                    <h1>Search Results</h1>
                    @forelse($results as $result)
                        <div class="col-md-3 col-sm-4 col-xs-6" style="align-items: center;">
                            <img class="img-responsive" src="{{url('/user-avatar/'.$result->id.'/250')}}" alt="User avatar">
                               <a href="{{url('/users/'.$result->id)}}"><h5 class="user-name">{{$result->name}}</h5></a>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <h5>Sorry, no results for phrase "{{$search_phrase}}"</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{ $results->links() }}
            </div>
        </div>




@endsection