<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Email Confirmation</title>
<body>
<img src="{{ URL::asset('images/logo/foookat_logo_alpha.png') }}"/>
<p>
    Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
</p>
</body>
</html>