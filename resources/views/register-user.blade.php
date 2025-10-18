<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <div style="margin-bottom:12px;">
        <a href="{{ route('rescue.form') }}"><button style="padding:6px 10px;background:#2b6cb0;color:#fff;border:none;border-radius:4px;">Rescuing</button></a>
    </div>
    <form action="{{ route('register.user.submit') }}" method="POST">
        @csrf
        @if($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Register</button>
    </form>
    <br>
    <a href="{{ route('login') }}">Back to Login</a>
</body>
</html>
