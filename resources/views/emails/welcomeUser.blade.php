{{-- filepath: c:\Users\21627\Desktop\first_laravel\task_manager\resources\views\emails\welcomeUser.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Manager</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .welcome-title {
            font-size: 28px;
            margin: 0;
            font-weight: 300;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .intro-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .features-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }
        .features-title {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .feature-icon {
            font-size: 24px;
            margin-right: 12px;
            width: 35px;
            text-align: center;
        }
        .feature-text {
            font-size: 14px;
            color: #555;
        }
        .cta-section {
            text-align: center;
            margin: 35px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 15px 35px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .support-section {
            background-color: #e8f4f8;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 30px 0;
            border-radius: 0 8px 8px 0;
        }
        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 30px;
            text-align: center;
        }
        .footer-links {
            margin: 15px 0;
        }
        .footer-links a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
        }
        .unsubscribe {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 15px;
        }
        @media (max-width: 600px) {
            .feature-grid {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 20px;
            }
            .header {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">📋 Task Manager</div>
            <h1 class="welcome-title">Welcome Aboard!</h1>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="greeting">
                Hi {{ $user->name ?? 'there' }}! 👋
            </div>

            <div class="intro-text">
                We're absolutely thrilled to have you join the Task Manager family! Your account has been successfully created, and you're now ready to take control of your productivity like never before.
            </div>

            <!-- Features Section -->
            <div class="features-section">
                <h3 class="features-title">🚀 What awaits you:</h3>
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon">✅</div>
                        <div class="feature-text">Create & manage personal tasks</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📂</div>
                        <div class="feature-text">Organize with smart categories</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">⭐</div>
                        <div class="feature-text">Mark favorites for quick access</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">👤</div>
                        <div class="feature-text">Personalize your profile</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔒</div>
                        <div class="feature-text">Secure API integration</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📱</div>
                        <div class="feature-text">Access from anywhere</div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="cta-section">
                <p style="margin-bottom: 20px; color: #555;">Ready to boost your productivity?</p>
                <a href="{{ config('app.url') }}/dashboard" class="cta-button">
                    Start Managing Tasks
                </a>
            </div>

            <!-- Support Section -->
            <div class="support-section">
                <strong>💡 Need help getting started?</strong><br>
                Our friendly support team is here to help you every step of the way. Don't hesitate to reach out if you have any questions!
            </div>

            <p style="color: #555; margin-top: 30px;">
                Welcome to a more organized, productive you!<br>
                <strong>The Task Manager Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>
                <strong>Task Manager</strong><br>
                Making productivity simple and beautiful
            </div>

            <div class="footer-links">
                <a href="{{ config('app.url') }}">Visit Website</a> |
                <a href="{{ config('app.url') }}/support">Get Support</a> |
                <a href="{{ config('app.url') }}/privacy">Privacy Policy</a>
            </div>

            <div class="unsubscribe">
                This email was sent to {{ $user->email ?? 'your email' }}<br>
                If you didn't create this account, please contact us immediately.
            </div>
        </div>
    </div>
</body>
</html>
