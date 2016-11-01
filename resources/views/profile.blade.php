@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                     <form class="form-horizontal" method="POST">
                     {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" id="email" placeholder="Enter email">
                        </div>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group{{ $errors->has('pswd') ? ' has-error' : '' }}">
                        <label class="control-label col-sm-2" for="pswd">Password:</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="pswd" id="pswd" placeholder="Enter password">
                        </div>
                        @if ($errors->has('pswd'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pswd') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="pswd2">Repeate password:</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="pswd2" name="pswd2" placeholder="Repeate password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection