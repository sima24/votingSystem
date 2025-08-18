<?php
session_start();
if(!isset($_SESSION['name'])){
    echo "<script> alert('at first login'); window.location.href='login.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%);
            z-index: -2;
        }

        /* Floating geometric shapes */
        .bg-shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation: float 7s ease-in-out infinite;
        }

        .shape-4 {
            width: 80px;
            height: 80px;
            top: 30%;
            right: 30%;
            animation: float 5s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Navbar styling */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            position: relative;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            transition: all 0.3s ease;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .navbar-brand .highlight {
            color: #facc15;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Profile dropdown */
        .dropdown-toggle {
            background: linear-gradient(135deg, #facc15 0%, #f59e0b 100%);
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(245, 204, 21, 0.3);
        }

        .dropdown-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 204, 21, 0.4);
        }

        .dropdown-toggle:focus {
            box-shadow: 0 0 0 3px rgba(245, 204, 21, 0.3);
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border-radius: 15px;
            z-index: 9999;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 2px 5px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        /* Main content */
        .main-content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            margin: 2rem;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .welcome-text {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 1rem;
        }

        .welcome-name {
            color: #facc15;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .description-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Action cards */
        .action-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .action-card:hover::before {
            transform: scaleX(1);
        }

        .action-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(31, 38, 135, 0.5);
        }

        .card-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .action-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .card-title {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .card-description {
            color: #666;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        /* Action buttons */
        .action-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .action-btn:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        /* Color variations */
        .vote-card {
            display: block !important;
            visibility: visible !important;
        }
        
        .vote-card .card-icon {
            color: #28a745 !important;
            display: block !important;
        }

        .vote-card .action-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            display: inline-block !important;
        }

        .vote-card .action-btn:hover {
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        }

        .result-card .card-icon {
            color: #ffc107;
        }

        .result-card .action-btn {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
            color: #333;
        }

        .result-card .action-btn:hover {
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            color: #333;
        }

        .result-card .action-btn:focus {
            color: #333;
        }

        /* Link styling */
        .card-link {
            text-decoration: none !important;
            color: inherit !important;
            display: block;
        }

        .card-link:hover {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* Animation for cards */
        .action-card {
            animation: fadeInUp 0.6s ease forwards !important;
            opacity: 0;
            transform: translateY(30px);
        }

        .vote-card {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .action-card:nth-child(1) { animation-delay: 0.2s; }
        .action-card:nth-child(2) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pulse animation */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .welcome-text {
                font-size: 2rem;
            }
            
            .main-content {
                margin: 1rem;
                padding: 1rem;
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }

            .card-icon {
                font-size: 3rem;
            }

            .action-btn {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }

        /* Additional decorative elements */
        .decorative-line {
            height: 2px;
            background: linear-gradient(135deg, #facc15 0%, transparent 100%);
            margin: 1rem 0;
            border-radius: 2px;
        }

        /* Status indicator */
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(40, 167, 69, 0.3);
        }
    </style>
</head>
<body>
    <!-- Background shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>
    <div class="bg-shape shape-4"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list text-white fs-3"></i>
            </button>
            
            <a class="navbar-brand text-white" href="#">
                Online <span class="highlight">Voting System</span>
            </a>

            <div class="collapse navbar-collapse">
                <div class="dropdown ms-auto">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2"></i><?php echo $_SESSION['name']; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="ch_pass.php"><i class="bi bi-key me-2"></i>Change Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="status-badge">
            <i class="bi bi-check-circle me-2"></i>Voting System Active
        </div>
        
        <h1 class="welcome-text">
            Welcome <span class="welcome-name"><?php echo $_SESSION['name']; ?></span>
        </h1>
        
        <div class="decorative-line"></div>

        <p class="description-text">
            Exercise your democratic right! Our secure online voting platform ensures your voice is heard while maintaining complete privacy and security. Cast your vote for the candidates of your choice or view real-time results from ongoing elections.
        </p>

        <!-- Action Cards Section -->
        <div class="container-fluid">
            <div class="row g-4">
                <!-- Give Vote Card -->
                <div class="col-lg-6 col-md-12" style="display: block; visibility: visible;">
                    <div class="card action-card vote-card pulse" style="display: block; visibility: visible; opacity: 1; background: rgba(255, 255, 255, 0.95); border-radius: 20px;">
                        <div class="card-body text-center p-4" style="display: block;">
                            <div class="card-icon" style="color: #28a745; font-size: 4rem; margin-bottom: 1rem;">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                            </div>
                            <h3 class="card-title" style="color: #333; font-weight: 700; font-size: 1.5rem; margin-bottom: 1rem;">Cast Your Vote</h3>
                            <p class="card-description" style="color: #666; font-size: 1rem; margin-bottom: 2rem; line-height: 1.5;">
                                Participate in the democratic process by casting your vote for your preferred candidates. Your vote is secure, private, and counts towards shaping the future.
                            </p>
                            <a href="give_vote.php" class="text-decoration-none">
                                <button type="button" class="action-btn" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; color: white; font-weight: 600; padding: 15px 30px; border-radius: 50px; font-size: 1.1rem;">
                                    <i class="bi bi-ballot me-2"></i>Give Vote
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Show Result Card -->
                <div class="col-lg-6 col-md-12">
                    <div class="card action-card result-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon">
                                <i class="bi bi-bar-chart-line-fill"></i>
                            </div>
                            <h3 class="card-title">View Results</h3>
                            <p class="card-description">
                                Stay informed about the election progress and results. View real-time voting statistics, candidate standings, and detailed analytical reports.
                            </p>
                            <a href="showResult.php" class="text-decoration-none">
                                <button type="button" class="action-btn">
                                    <i class="bi bi-graph-up me-2"></i>Show Results
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="mt-5">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="text-white">
                        <i class="bi bi-shield-check fs-1 text-success mb-2"></i>
                        <h5>Secure Voting</h5>
                        <p class="small">End-to-end encrypted voting process</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="text-white">
                        <i class="bi bi-eye-slash fs-1 text-primary mb-2"></i>
                        <h5>Anonymous</h5>
                        <p class="small">Your vote remains completely private</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="text-white">
                        <i class="bi bi-clock fs-1 text-warning mb-2"></i>
                        <h5>Real-time</h5>
                        <p class="small">Live updates and instant results</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    
    <script>
        // Interactive enhancements
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.action-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    let ripple = document.createElement('span');
                    let rect = this.getBoundingClientRect();
                    let size = Math.max(rect.width, rect.height);
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                    ripple.classList.add('ripple-effect');
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add parallax effect to shapes
            window.addEventListener('mousemove', function(e) {
                const shapes = document.querySelectorAll('.bg-shape');
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;
                
                shapes.forEach((shape, index) => {
                    const speed = (index + 1) * 0.05;
                    const xPos = (x - 0.5) * speed * 100;
                    const yPos = (y - 0.5) * speed * 100;
                    shape.style.transform = `translate(${xPos}px, ${yPos}px)`;
                });
            });
        });
    </script>

    <style>
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>