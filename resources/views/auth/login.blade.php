@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="content">
            <form class="form-horizontal login-form" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <h3 class="form-title font-green">Sign In</h3>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="email" class="form-control  form-control-solid placeholder-no-fix" placeholder="E-mail / username" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-actions">
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <div class="checkbox">
                              <label class="rememberme">
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-primary">
                              Login
                          </button>

                          <a class="btn forget-password" href="{{ route('password.request') }}">
                              Forgot Your Password?
                          </a>
                      </div>
                  </div>
              </div>
              <div class="login-options">
                  <h4>Or login with</h4>
                  <ul class="social-icons">
                      <li>
                          <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                      </li>
                      <li>
                          <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                      </li>
                      <li>
                          <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="{{ route('login/google') }}"></a>
                      </li>
                      <li>
                          <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                      </li>
                  </ul>
              </div>
              <div class="create-account">
                  <p>
                      <a href="{{ route('register') }}" id="register-btn" class="uppercase">Create an account</a>
                  </p>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
