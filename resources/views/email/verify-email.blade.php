<!-- verify-email.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <h2>Verify Your Email</h2>
    <p>Hello {{ $user->name }},</p>
    <p>Please click the following link to verify your email address:</p>
    <a href="{{ route('verify.email', ['token' => $verificationToken]) }}">Verify Email</a>
</body>

</html>