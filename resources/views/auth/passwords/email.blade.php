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
</head>
<body class="gray-bg">
<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content">
                <h2 class="font-bold">Forgot password</h2>
                <p>
                    Enter your email address and your password will be reset and emailed to you.
                </p>
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email"  placeholder="Email address" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary block full-width m-b">
                                        <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                    </button>
                                    <p class="m-t text-center">
                                        <a href="{{ url('/login') }}">Back to Login</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p class="m-t text-center"> <small>&copy; Copyrights Foookat Online Services 2016</small></p>
        </div>
    </div>
</div>
</body>
</html>
