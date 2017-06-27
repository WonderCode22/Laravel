@extends('layouts.app')
@section('login_link')
  <script src = 'js/angular.js'></script>
  <script src = 'js/country.js'></script>
@section('content')
<div class="container">
    <div class="row">
        <div class="content">
            <form class=" form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <h3 class="font-green">Sign Up</h3>
                <p class="hint"> Enter your personal details below: </p>
                <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="fullname" type="text" class="form-control" placeholder="Full Name" name="fullname" value="{{ old('fullname') }}" required autofocus>

                        @if ($errors->has('fullname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fullname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="city" type="text" class="form-control" placeholder="City/Town" name="city" value="{{ old('city') }}" required autofocus>

                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                      <div ng-app = "countryApp" ng-controller = "countryCtrl">
                        <select id="city" type="text" class="form-control" placeholder="Country" name="country" value="{{ old('country') }}" required autofocus>
                          <option ng-repeat = "country in countries" value = '<%country.value%>'>
                            <% country.name %>
                          </option>
                        </select>
                      </div>
                        @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="username" type="text" class="form-control" placeholder="username" name="username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary pull-right">
                        Register
                    </button>
                    <a type="button" id="register-back-btn" href = "{{ route('login') }}" class="btn green btn-outline">
                        Back
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
