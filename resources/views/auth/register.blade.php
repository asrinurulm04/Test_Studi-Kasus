<!DOCTYPE html>
<html lang="en">
  <head>
    <title>REGISTER</title>
    <link href="{{ asset('images/logo2.png') }}" rel="icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrapp.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/utill.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mainn.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/asri.css') }}">
  </head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/background.jpg');">
			<div class="wrap-login100">
				<span class="login100-form-title p-b-34 p-t-27">  Register Now</span>
        <div class="container">
          <form class="form-login" method="post" action="{{ route('register') }}">
          <div class="login-wrap">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-12 control-label">Name</label>
              <div class="col-md-12">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-12 control-label">E-Mail Address</label>
              <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Password</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 control-label">Confirm Password</label>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-12">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                {{ csrf_field() }}
              @if(count($errors) > 0)
              <br><div class="alert alert-danger" style="font-size:11px">
                <strong>Whoops!</strong><br>
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
                            </div>
                        </div>
            </form>
            <div class="form-group registration text-center">
              <a href="{{ route('signin') }}">
                <h6 style="color:#fff">Already Have account ? Login</h6>
                </a>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrapp.min.js') }}"></script>
	<script src="{{ asset('assets/js/mainn.js') }}"></script>
</body>
</html>