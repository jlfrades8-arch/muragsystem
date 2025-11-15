# Email Configuration Guide

## Current Setup (Development)

The system is currently configured to use the `log` mail driver, which saves all emails to `storage/logs/laravel.log` instead of sending them.

## For Development Testing with Real Emails

### Option 1: Mailtrap (Recommended for Development)

Mailtrap is a fake SMTP server for development testing.

1. Sign up at https://mailtrap.io (free tier available)
2. Create an inbox
3. Update your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@petadoption.local"
MAIL_FROM_NAME="Pet Adoption System"
```

### Option 2: Gmail SMTP (Quick Testing)

1. Enable 2-factor authentication on your Gmail account
2. Generate an App Password: https://myaccount.google.com/apppasswords
3. Update your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="Pet Adoption System"
```
