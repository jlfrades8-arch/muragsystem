<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #a855f7;
            padding-bottom: 20px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 15px;
        }

        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 28px;
        }

        .content {
            margin: 30px 0;
        }

        .content p {
            margin: 15px 0;
            font-size: 16px;
        }

        .reset-link {
            display: inline-block;
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            color: white;
            padding: 12px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }

        .reset-link:hover {
            opacity: 0.9;
        }

        .alt-link {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            word-break: break-all;
            font-size: 14px;
            color: #666;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #999;
        }

        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 14px;
        }

        strong {
            color: #1f2937;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('images/logo/Pet.png') }}" alt="Pet Adoption Logo" class="logo">
            <h1>Password Reset Request</h1>
        </div>

        <!-- Main Content -->
        <div class="content">
            <p>Hello,</p>

            <p>
                You are receiving this email because we received a password reset request for your account on the
                <strong>Pet Adoption System</strong>.
            </p>

            <p style="text-align: center;">
                <a href="{{ $resetUrl }}" class="reset-link">Reset Your Password</a>
            </p>

            <p style="text-align: center; margin-top: 20px;">
                <strong>Or copy and paste this link in your browser:</strong>
            </p>

            <div class="alt-link">
                {{ $resetUrl }}
            </div>

            <div class="warning">
                <strong>⏱️ Important:</strong> This password reset link will expire in <strong>24 hours</strong>.
                If you don't complete the reset within this time, you'll need to request a new one.
            </div>

            <p>
                If you did not request a password reset, <strong>no further action is required</strong>. Your password
                will remain unchanged, and your account will stay secure.
            </p>

            <p>
                For security reasons, never share this link with anyone. Pet Adoption System staff will never ask for
                your password or reset link.
            </p>

            <p>
                Best regards,<br>
                <strong>The Pet Adoption System Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                © 2025 Pet Adoption System. Saving lives, one paw at a time. | All rights reserved.<br>
                If you have any questions, please contact our support team.
            </p>
        </div>
    </div>
</body>

</html>
