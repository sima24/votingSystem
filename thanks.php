<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Voting!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .thank-you-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .thank-you-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }
        
        .checkmark {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #4CAF50, #45a049);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: scaleIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        @keyframes scaleIn {
            0% { transform: scale(0) rotate(0deg); }
            50% { transform: scale(1.2) rotate(180deg); }
            100% { transform: scale(1) rotate(360deg); }
        }
        
        .checkmark::after {
            content: '✓';
            color: white;
            font-size: 50px;
            font-weight: bold;
        }
        
        h1 {
            color: #333;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease 0.3s both;
        }
        
        .message {
            color: #666;
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 40px;
            animation: fadeInUp 1s ease 0.6s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .back-button {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1em;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease 0.9s both;
        }
        
        .back-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }
        
        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .back-button:hover::before {
            left: 100%;
        }
        
        .back-button:active {
            transform: translateY(-1px);
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            animation: confettiFall 3s linear infinite;
        }
        
        @keyframes confettiFall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }
        
        .confetti:nth-child(1) { left: 10%; background: #ff6b6b; animation-delay: 0s; }
        .confetti:nth-child(2) { left: 20%; background: #4ecdc4; animation-delay: 0.2s; }
        .confetti:nth-child(3) { left: 30%; background: #45b7d1; animation-delay: 0.4s; }
        .confetti:nth-child(4) { left: 40%; background: #96ceb4; animation-delay: 0.6s; }
        .confetti:nth-child(5) { left: 50%; background: #ffeaa7; animation-delay: 0.8s; }
        .confetti:nth-child(6) { left: 60%; background: #fab1a0; animation-delay: 1s; }
        .confetti:nth-child(7) { left: 70%; background: #fd79a8; animation-delay: 1.2s; }
        .confetti:nth-child(8) { left: 80%; background: #fdcb6e; animation-delay: 1.4s; }
        .confetti:nth-child(9) { left: 90%; background: #6c5ce7; animation-delay: 1.6s; }
        
        @media (max-width: 480px) {
            .thank-you-container {
                padding: 40px 30px;
            }
            
            h1 {
                font-size: 2em;
            }
            
            .message {
                font-size: 1.1em;
            }
            
            .checkmark {
                width: 80px;
                height: 80px;
            }
            
            .checkmark::after {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        
        <div class="checkmark"></div>
        
        <h1>Thank You!</h1>
        
        <p class="message">
            Your vote has been successfully recorded. Thank you for participating and making your voice heard!
        </p>
        
        <button class="back-button" onclick="goBack()">
            ← Back to Main Page
        </button>
    </div>
    
    <script>
        function goBack() {
           
          
            window.history.back();
            
           
        }
        
       
        setTimeout(() => {
            const container = document.querySelector('.thank-you-container');
            for (let i = 0; i < 20; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 70%, 60%)`;
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                container.appendChild(confetti);
                
                // Remove confetti after animation
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.parentNode.removeChild(confetti);
                    }
                }, 4000);
            }
        }, 500);
    </script>
</body>
</html>