<!DOCTYPE html>
<html>
<head>
    <title>Select Registration Type</title>
</head>
<body>
    <h2>Register As</h2>
    
    <a href="{{ route('register.user') }}"><button>Register as User</button></a>
    <a href="{{ route('register.admin') }}"><button>Register as Admin</button></a>
    <div style="margin-top:20px;">
        <a href="{{ route('login') }}"><button style="padding:6px 10px;background:#6c757d;color:#fff;border:none;border-radius:4px;">Back to Login</button></a>
    </div>
</body>
</html>
