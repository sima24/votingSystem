<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Create Account</title>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .registration-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 32px 64px rgba(0, 0, 0, 0.15);
            padding: 48px 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
            max-width: 100%;
        }

        .registration-container::before {
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

        .row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .col-md-6 {
            grid-column: 1;
        }

        .col-12 {
            grid-column: 1;
        }

        .form-group {
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

        .error:not(:empty) {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gender radio buttons styling */
        .gender-section {
            margin-bottom: 24px;
        }

        .gender-section label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
            font-size: 14px;
            display: block;
        }

        .form-check {
            display: inline-flex;
            align-items: center;
            margin-right: 24px;
            margin-bottom: 8px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            accent-color: #667eea;
        }

        .form-check-label {
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        /* Address fieldset styling */
        .address-section {
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            position: relative;
            background: #fafafa;
            transition: all 0.3s ease;
        }

        .address-section:focus-within {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.05);
        }

        .address-legend {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            position: absolute;
            top: -12px;
            left: 20px;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
        }

        .address-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 16px;
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
            margin-top: 24px;
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

        /* Responsive design */
        @media (min-width: 768px) {
            .row {
                grid-template-columns: 1fr 1fr;
            }
            
            .col-12 {
                grid-column: 1 / -1;
            }
            
            .gender-section {
                grid-column: 1 / -1;
            }
            
            .address-section {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 480px) {
            .registration-container {
                padding: 32px 24px;
                margin: 16px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .address-grid {
                grid-template-columns: 1fr;
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

        /* Loading state */
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
    <div class="container">
        <div class="registration-container">
            <div class="logo-section">
                <div class="logo">R</div>
                <h1>Create Account</h1>
                <p class="subtitle">Join us and start your journey</p>
            </div>

            <div class="success-message" id="success-message">
                Registration successful! Please wait...
            </div>

            <form class="row g-3" id="regi" action="regAct.php" method="post">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
                        <span class="error" id="name-err"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        <span class="error" id="email-err"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Create a password">
                        <span class="error" id="password-err"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                        <span class="error" id="dob-err"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter 10-digit mobile">
                        <span class="error" id="mobile-err"></span>
                    </div>
                </div>

                <div class="gender-section">
                    <label>Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="other" id="other">
                            <label class="form-check-label" for="other">Others</label>
                        </div>
                    </div>
                    <span class="error" id="gender-err"></span>
                </div>

                <div class="address-section">
                    <div class="address-legend">Address Information</div>
                    <div class="address-grid">
                        <div class="form-group">
                            <label for="city" class="form-label">City/Village</label>
                            <input type="text" class="form-control" id="city" name="vill" placeholder="Enter city/village">
                            <span class="error" id="city-err"></span>
                        </div>
                        <div class="form-group">
                            <label for="po" class="form-label">Post Office</label>
                            <input type="text" class="form-control" id="po" name="po" placeholder="Enter post office">
                            <span class="error" id="po-err"></span>
                        </div>
                        <div class="form-group">
                            <label for="ps" class="form-label">Police Station</label>
                            <input type="text" class="form-control" id="ps" name="ps" placeholder="Enter police station">
                            <span class="error" id="ps-err"></span>
                        </div>
                        <div class="form-group">
                            <label for="dist" class="form-label">District</label>
                            <input type="text" class="form-control" id="dist" name="dist" placeholder="Enter district">
                            <span class="error" id="dist-err"></span>
                        </div>
                        <div class="form-group">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                            <span class="error" id="state-err"></span>
                        </div>
                        <div class="form-group">
                            <label for="pin" class="form-label">PIN Code</label>
                            <input type="number" class="form-control" id="pin" name="pin" placeholder="Enter 6-digit PIN">
                            <span class="error" id="pin-err"></span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn-primary" id="submit">
                        <div class="loading" id="loading"></div>
                        <span id="btn-text">Create Account</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#regi').on('submit', function (e) {
                let isValid = true;

                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const password = $('#Password').val().trim();
                const gender = $('input[name="gender"]:checked').val();
                const mobile = $('#mobile').val().trim();
                const dob = $('#dob').val().trim();
                const city = $('#city').val().trim();
                const po = $('#po').val().trim();
                const ps = $('#ps').val().trim();
                const dist = $('#dist').val().trim();
                const state = $('#state').val().trim();
                const pin = $('#pin').val().trim();

                $('.error').text('');

                if (!/^[A-Za-z\s]+$/.test(name)) {
                    $('#name-err').text('Enter a valid name.');
                    isValid = false;
                }
                if (!/^\S+@\S+\.\S+$/.test(email)) {
                    $('#email-err').text('Enter a valid email.');
                    isValid = false;
                }
                if (password.length < 6) {
                    $('#password-err').text('Password must be at least 6 characters.');
                    isValid = false;
                }
                if (dob !== "") {
                    const today = new Date();
                    const birth = new Date(dob);
                    const age = today.getFullYear() - birth.getFullYear();
                    if (age < 18) {
                        $('#dob-err').text('Age must be greater than 18 years.');
                        isValid = false;
                    }
                } else {
                    $('#dob-err').text('Date of birth is required.');
                    isValid = false;
                }
                if (!/^\d{10}$/.test(mobile)) {
                    $('#mobile-err').text('Enter a valid 10-digit mobile number.');
                    isValid = false;
                }
                if (!gender) {
                    $('#gender-err').text('Select gender.');
                    isValid = false;
                }
                if (city === "") { $('#city-err').text('Required'); isValid = false; }
                if (po === "") { $('#po-err').text('Required'); isValid = false; }
                if (ps === "") { $('#ps-err').text('Required'); isValid = false; }
                if (dist === "") { $('#dist-err').text('Required'); isValid = false; }
                if (state === "") { $('#state-err').text('Required'); isValid = false; }
                if (!/^\d{6}$/.test(pin)) {
                    $('#pin-err').text('Enter valid 6-digit pin code.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault(); // stop submission if errors
                } else {
                    // Show loading state
                    $('#submit').prop('disabled', true);
                    $('#loading').show();
                    $('#btn-text').text('Creating Account...');
                    
                    // Show success message after a delay
                    setTimeout(() => {
                        $('#success-message').show();
                        
                        // Reset button state
                        $('#submit').prop('disabled', false);
                        $('#loading').hide();
                        $('#btn-text').text('Create Account');
                        
                        // In real application, form would submit here
                        setTimeout(() => {
                            alert("please wait !");
                            // Form will submit normally since we don't prevent default here
                        }, 1000);
                    }, 1000);
                }
            });
        });
    </script>
</body>
</html>