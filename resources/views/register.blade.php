<!DOCTYPE html>
<html>
<head>
    <title>Select Registration Type</title>
</head>
<body>
    <h2>Register As</h2>
    <div style="margin-bottom:12px;">
        <a href="{{ route('rescue.form') }}"><button style="padding:6px 10px;background:#2b6cb0;color:#fff;border:none;border-radius:4px;">Rescuing</button></a>
    </div>
    <a href="{{ route('register.user') }}"><button>Register as User</button></a>
    <a href="{{ route('register.admin') }}"><button>Register as Admin</button></a>
</body>
</html>
