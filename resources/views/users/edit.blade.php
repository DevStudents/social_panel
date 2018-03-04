@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

     
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading">Edit: {{$user->id}}</div>
            <div class="panel-body">
              <form  method="POST" action="{{url('/users/'.$user->id)}}" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{method_field('PATCH')}}
                  <img src="{{url('/user-avatar/'.$user->id.'/350')}}" alt="avatar" class="img-responsive">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                              <label for="">Avatar</label>
                              <input type="file" class="form-control" name="avatar">
                          </div>
                          @if ($errors->has('avatar'))
                              <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                          @endif
                      </div>

                  </div>

                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="">Full name</label>
                            <input type="text" class="form-control" value="{{$user->name }}" name="name">
                          </div>
                          @if ($errors->has('name'))
                              <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                          @endif
                      </div>

                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="">E-mail</label>
                            <input type="text" class="form-control" value="{{$user->email}}" name="email">
                          </div>
                          @if ($errors->has('email'))
                              <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                          @endif
                      </div>

                  </div>
                  <div class="row">
                          <div class="col-sm-12">
                              <label for="">Sex</label>
                              <select class="form-control" id="sex" name="sex">
                                  <option value="f" @if($user->sex == 'f') selected @endif>Female</option>
                                  <option value="m" @if($user->sex == 'm') selected @endif>Male</option>
                                  <option value="x" @if($user->sex == 'x') selected @endif>Not your bussines!</option>
                              </select>
                          </div>
                      </div>
                  <button type="submit" class="btn btn-primary pull-left" >Save changes</button>
              </form>
            </div>    
        </div>
        </div>
    </div>
</div>
@endsection
