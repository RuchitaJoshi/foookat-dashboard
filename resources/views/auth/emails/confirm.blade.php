<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Email Confirmation</title>
<body>
<img src="{{ URL::asset('images/logo/foookat_logo_alpha.png') }}"/>
<h1>
    Welcome to Foookat
</h1>
<p>
    Thank you for signing up!
</p>
<p>
    We just need you to <a href='{{ url("user/activate/{$email_token}") }}'>confirm your email address</a> real quick!
</p>
</body>
</html>