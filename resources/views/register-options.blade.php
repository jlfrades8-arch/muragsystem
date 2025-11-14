<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choose Registration</title>
  <style>
    body {
      background-color: #0a192f;
      color: #64ffda;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
    }
    .auth-box {
      background-color: #112240;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      width: 350px;
    }
    button {
      display: block;
      width: 100%;
      margin: 10px 0;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #64ffda;
      color: #0a192f;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="auth-box">
    <h2>Choose Registration Type</h2>
    <button onclick="window.location.href='{{ route('register.user') }}'">Register as User</button>
    <button onclick="window.location.href='{{ route('register.admin') }}'">Register as Admin</button>
  <button onclick="window.location.href='{{ route('dashboard') }}'">Back to Dashboard</button>
  </div>
</body>
</html>
