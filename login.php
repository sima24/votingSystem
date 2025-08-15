<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Welcome Back</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 32px 64px rgba(0, 0, 0, 0.15);
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 16px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fafafa;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .form-control:focus + .form-label {
            color: #667eea;
        }

        .error {
            color: #ef4444;
            font-size: 12px;
            font-weight: 500;
            margin-top: 6px;
            display: block;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .error.show {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 48px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .forgot-password {
            text-align: center;
            margin-top: 24px;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #764ba2;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0;
            color: #9ca3af;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 16px;
        }

        .social-login {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            color: #374151;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-1px);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                margin: 16px;
            }
            
            h1 {
                font-size: 24px;
            }
        }

        /* Input validation states */
        .form-control.valid {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        .form-control.invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        /* Floating label effect */
        .form-group.floating {
            position: relative;
        }

        .form-group.floating .form-label {
            position: absolute;
            left: 20px;
            top: 18px;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #9ca3af;
            background: transparent;
            padding: 0 4px;
        }

        .form-group.floating .form-control:focus ~ .form-label,
        .form-group.floating .form-control:not(:placeholder-shown) ~ .form-label {
            top: -6px;
            left: 16px;
            font-size: 12px;
            color: #667eea;
            background: white;
            padding: 0 8px;
        }

        .success-message {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: none;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">L</div>
            <h1>Welcome Back</h1>
            <p class="subtitle">Sign in to your account</p>
        </div>

        <div class="success-message" id="success-message">
            Login successful! Redirecting...
        </div>

        <form id="regi" action="logAct.php" method="post">
            <div class="form-group floating">
                <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                <label for="email" class="form-label">Email Address</label>
                <span class="error" id="email-err"></span>
            </div>

            <div class="form-group floating">
                <input type="password" class="form-control" id="Password" name="password" placeholder=" " required>
                <label for="password" class="form-label">Password</label>
                <span class="error" id="password-err"></span>
            </div>

            <button type="submit" class="btn-primary" id="submitbtn">
                <div class="loading" id="loading"></div>
                <span id="btn-text">Sign In</span>
            </button>
        </form>

        <div class="forgot-password">
            <a href="#" onclick="alert('Forgot password functionality would be implemented here')">Forgot your password?</a>
        </div>

        <div class="divider">
            <span>or continue with</span>
        </div>

        <div class="social-login">
            <a href="#" class="social-btn" onclick="alert('Google login would be implemented here')">
                Google
            </a>
            <a href="#" class="social-btn" onclick="alert('GitHub login would be implemented here')">
                GitHub
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('regi');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('Password');
            const submitBtn = document.getElementById('submitbtn');
            const loading = document.getElementById('loading');
            const btnText = document.getElementById('btn-text');

            // Real-time validation
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', validatePassword);

            function validateEmail() {
                const email = emailInput.value.trim();
                const emailErr = document.getElementById('email-err');
                const emailPattern = /^\S+@\S+\.\S+$/;
                
                if (email === '') {
                    emailInput.classList.remove('valid', 'invalid');
                    emailErr.classList.remove('show');
                    return false;
                } else if (!emailPattern.test(email)) {
                    emailInput.classList.remove('valid');
                    emailInput.classList.add('invalid');
                    emailErr.textContent = 'Please enter a valid email address';
                    emailErr.classList.add('show');
                    return false;
                } else {
                    emailInput.classList.remove('invalid');
                    emailInput.classList.add('valid');
                    emailErr.classList.remove('show');
                    return true;
                }
            }

            function validatePassword() {
                const password = passwordInput.value.trim();
                const passwordErr = document.getElementById('password-err');
                
                if (password === '') {
                    passwordInput.classList.remove('valid', 'invalid');
                    passwordErr.classList.remove('show');
                    return false;
                } else if (password.length < 6) {
                    passwordInput.classList.remove('valid');
                    passwordInput.classList.add('invalid');
                    passwordErr.textContent = 'Password must be at least 6 characters long';
                    passwordErr.classList.add('show');
                    return false;
                } else {
                    passwordInput.classList.remove('invalid');
                    passwordInput.classList.add('valid');
                    passwordErr.classList.remove('show');
                    return true;
                }
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                
                if (!isEmailValid || !isPasswordValid) {
                    // Shake animation for invalid form
                    form.style.animation = 'none';
                    setTimeout(() => {
                        form.style.animation = '';
                    }, 10);
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                loading.style.display = 'inline-block';
                btnText.textContent = 'Signing In...';

                // Simulate login process
                form.submit();
            });

            // Add shake animation for form validation errors
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>