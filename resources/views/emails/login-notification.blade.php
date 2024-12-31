<!-- resources/views/emails/registration-notification.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registration</title>
</head>
<body>
    <h1>Welcome {{ $user->name }},</h1>

    <p>Thank you for registering with our application. We're excited to have you on board!</p>

    <p>Your account has been successfully created, and here are your registration details:</p>

    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>If you did not register for this account, please contact our support team immediately.</p>

    <p>Login at: <a href="{{ url('/login') }}">Login Page</a></p>

    <p>If you need any assistance, please do not hesitate to contact support.</p>
</body>
</html>
