<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    .container {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      color: white;
    }

    .logo {
      width: 80px;
      height: 80px;
      background: white;
      border-radius: 50%;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .content {
      background: white;
      border-radius: 10px;
      padding: 30px;
      margin-top: 20px;
      color: #333;
    }

    .button {
      display: inline-block;
      padding: 15px 30px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      margin: 20px 0;
    }

    .footer {
      text-align: center;
      margin-top: 30px;
      color: #666;
      font-size: 12px;
    }

    .link {
      word-break: break-all;
      color: #667eea;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="#667eea">
        <path d="M12 2a4 4 0 00-4 4c0 2 2 5 4 7 2-2 4-5 4-7a4 4 0 00-4-4z" />
        <path d="M6 14c-1 1-2 3-2 4 0 1 1 2 2 2s2-1 2-2c0-1-1-3-2-4zM18 14c1 1 2 3 2 4 0 1-1 2-2 2s-2-1-2-2c0-1 1-3 2-4z" />
      </svg>
    </div>
    <h1 style="margin: 0; font-size: 28px;">Reset Your Password</h1>
    <p style="margin: 10px 0 0; font-size: 16px; opacity: 0.9;">Pet Adoption System</p>
  </div>

  <div class="content">
    <h2 style="color: #667eea; margin-top: 0;">Hello!</h2>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    <p style="text-align: center;">
      <a href="{{ $resetUrl }}" class="button">Reset Password</a>
    </p>

    <p style="font-size: 14px; color: #666;">
      This password reset link will expire in 24 hours.
    </p>

    <p style="font-size: 14px; color: #666;">
      If the button above doesn't work, copy and paste this URL into your browser:
    </p>

    <p style="background: #f5f5f5; padding: 15px; border-radius: 5px; font-size: 13px;">
      <a href="{{ $resetUrl }}" class="link">{{ $resetUrl }}</a>
    </p>

    <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

    <p style="font-size: 14px; color: #666;">
      If you did not request a password reset, no further action is required. Your password will remain unchanged.
    </p>
  </div>

  <div class="footer">
    <p>© {{ date('Y') }} Pet Adoption System. All rights reserved.</p>
    <p>This is an automated message, please do not reply to this email.</p>
  </div>
</body>

</html>