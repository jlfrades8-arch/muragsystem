<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2>Login</h2>
        <a href="{{ route('rescue.form') }}"><button style="padding:6px 10px;background:#2b6cb0;color:#fff;border:none;border-radius:4px;">Rescuing</button></a>
    </div>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <br>
    <a href="{{ route('register.select') }}">Register</a>
</body>
</html>
