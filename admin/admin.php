<?php
include '../db_conn.php';
session_start();
if(!isset($_SESSION['admin_name'])){
    echo "<script> alert('at first login'); window.location.href='admin_login.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


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
        .profile-img {
            border: 3px solid #facc15;
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(250, 204, 21, 0.5);
        }

        .dropdown-toggle {
            color: white !important;
            font-weight: 600;
            border: none;
            background: transparent;
        }

        .dropdown-toggle:focus {
            box-shadow: none;
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
            margin-bottom: 2rem;
        }

        .welcome-name {
            color: #facc15;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Dashboard cards */
        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .dashboard-card::before {
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

        .dashboard-card:hover::before {
            transform: scaleX(1);
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(31, 38, 135, 0.5);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .card-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .card-subtitle {
            color: #666;
            font-size: 0.9rem;
        }

        /* Color variations for cards */
        .card-primary .card-number,
        .card-primary .card-icon {
            color: #667eea;
        }

        .card-success .card-number,
        .card-success .card-icon {
            color: #28a745;
        }

        .card-success .card-title {
            color: #28a745 !important;
        }

        .card-warning .card-number,
        .card-warning .card-icon {
            color: #ffc107;
        }

        .card-danger .card-number,
        .card-danger .card-icon {
            color: #dc3545;
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

        .card-link:focus {
            color: inherit !important;
            text-decoration: none !important;
        }

        .card-link:visited {
            color: inherit !important;
            text-decoration: none !important;
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
        }

        /* Animation for cards */
        .dashboard-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(3) { animation-delay: 0.3s; }
        .dashboard-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pulse animation for important elements */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
    </style>
</head>
<body>
    <!-- Background shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

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
                <div class="dropdown ms-auto d-flex align-items-center">
                    <img src="../image/<?php echo $_SESSION['admin_img']; ?>" 
                         alt="Profile" 
                         class="rounded-circle me-3 profile-img" 
                         width="45" height="45">
                
                    <button class="btn dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-5 fw-semibold"><?php echo $_SESSION['admin_name']; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="edit_pro.php"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="change.php"></i>Change Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="welcome-text">
            Welcome <span class="welcome-name"><?php echo $_SESSION['admin_name']; ?></span>
        </h1>

        <!-- Dashboard Features Section -->
        <div class="container-fluid">
            <div class="row g-4">
                <!-- Agent Count -->
                <div class="col-lg-3 col-md-6">
                    <div class="card dashboard-card card-primary h-100">
                        <div class="card-body text-center p-4">
                            <?php
                                $sel="select count(*) as total from agent";
                                $run1=mysqli_query($conn, $sel) or die("query unsuccessful!");
                                $row = mysqli_fetch_assoc($run1);
                                $agentCount = $row['total'];
                            ?>
                            <div class="card-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="card-number"><?php echo $agentCount; ?></div>
                            <h5 class="card-title">Total Agents</h5>
                            <p class="card-subtitle">Registered agents in system</p>
                        </div>
                    </div>
                </div>

               <!-- Add Agent -->
                <div class="col-lg-3 col-md-6">
                    <a href="add_agent.php" class="card-link">
                        <div class="card dashboard-card card-success h-100">
                            <div class="card-body text-center p-4">
                                <div class="card-icon text-success">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <div class="card-number text-success">+</div>
                                <h5 class="card-title text-success">Add Agent</h5>
                                <p class="card-subtitle">Register new agent</p>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- All Agents -->
                <div class="col-lg-3 col-md-6">
                    <a href="all_agent.php" class="card-link">
                        <div class="card dashboard-card card-warning h-100">
                            <div class="card-body text-center p-4">
                                <div class="card-icon">
                                    <i class="bi bi-list-ul"></i>
                                </div>
                                <div class="card-number">
                                    <i class="bi bi-eye-fill"></i>
                                </div>
                                <h5 class="card-title">All Agents</h5>
                                <p class="card-subtitle">View and manage agents</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Result -->
                <div class="col-lg-3 col-md-6">
                    <a href="publish_res.php" class="card-link">
                        <div class="card dashboard-card card-danger h-100">
                            <div class="card-body text-center p-4">
                                <div class="card-icon">
                                    <i class="bi bi-bar-chart-fill"></i>
                                </div>
                                <div class="card-number">
                                    <i class="bi bi-trophy-fill"></i>
                                </div>
                                <h5 class="card-title">Results</h5>
                                <p class="card-subtitle">View voting results</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    
    <script>
        // Add some interactive behavior
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to cards
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    let ripple = document.createElement('span');
                    let rect = this.getBoundingClientRect();
                    let size = Math.max(rect.width, rect.height);
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: rippleEffect 0.6s linear;
            pointer-events: none;
        }

        @keyframes rippleEffect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>