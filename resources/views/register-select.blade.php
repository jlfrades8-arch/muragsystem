<!DOCTYPE html>
<html>
<head>
    <title>Select Registration</title>
</head>
<body style="text-align:center; margin-top:100px;">
    <h2>Register As</h2>

    <!-- Two separate buttons for User or Admin registration -->
    <a href="{{ route('register.user') }}">
        <button>Register as User</button>
    </a>
    &nbsp;&nbsp;
    <a href="{{ route('register.admin') }}">
        <button>Register as Admin</button>
    </a>

    <br><br>
    <!-- Back to Login -->
    <a href="{{ route('login') }}">Back to Login</a>
</body>
</html>
