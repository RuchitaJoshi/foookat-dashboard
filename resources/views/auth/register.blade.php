<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foookat Online Services</title>
    <link href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/inspinia/style.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/custom/style.css') }}" rel="stylesheet">
</head>
<body class="gray-bg">
<img class="body-background img-responsive"
     src="{{ URL::asset('images/backgrounds/cafe.jpg') }}"/>
<div class="black-overlay">
    <div class="middle-box text-center animated fadeInDown">
        <div>
            <img class="img-responsive" src="{{ URL::asset('images/logo/foookat_logo_alpha.png') }}"/>
            <h3>Get Your Business Listed</h3>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name"
                               value="{{ old('first_name') }}">
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                               value="{{ old('last_name') }}">
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="email" placeholder="Email Address"
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password_confirmation"
                               placeholder="Confirm Password">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary full-width m-b">
                            <i class="fa fa-btn fa-user"></i>Register
                        </button>
                        <p class="m-t text-center">
                            <a href="{{ url('/login') }}">Already have an account?</a>
                        </p>
                    </div>
                </div>
            </form>
            <p class="m-t">
                <small>&copy; Copyrights Foookat Online Services 2016</small>
            </p>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="{{ URL::asset('js/jquery/jquery-2.1.1.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>
