<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Password</title>
</head>
<body>
  <p>Hello,</p>
  <p>Your new password is: <strong>{{ $newPassword }}</strong></p>
  <p>Please use this password to log in to your account.</p>
  <p><a href="{{ route('login') }}">Login Now</a></p>
</body>
</html>
