<?php
include '../db_conn.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    echo "<script> alert('Please login as admin first'); window.location.href='admin_login.php'; </script>";
    exit();
}

//publish the result
if (isset($_POST['publish'])) {
    $stmt = $conn->prepare("UPDATE settings SET results_published = 1 WHERE id = 1");
    $stmt->execute();
    echo "<script>alert('Results Published Successfully!'); window.location.href('publish_res.php');</script>";
}

// Check if results are published
$published_query = "SELECT results_published FROM settings WHERE id = 1";
$published_result = $conn->query($published_query);
$is_published = ($published_result && $published_result->num_rows > 0) ? $published_result->fetch_assoc()['results_published'] : 0;

// Get voting details
$query = "
    SELECT u.name AS user_name, a.name AS agent_name, a.party_name, v.vote_time
    FROM votes v
    JOIN details u ON v.user_id = u.id
    JOIN agent a ON v.agent_id = a.id
    ORDER BY v.vote_time DESC
";
$result = $conn->query($query);

// Get voting statistics
$stats_query = "
    SELECT 
        a.name AS agent_name, 
        a.party_name,
        COUNT(v.agent_id) as vote_count,
        ROUND((COUNT(v.agent_id) * 100.0 / (SELECT COUNT(*) FROM votes)), 2) as percentage
    FROM agent a
    LEFT JOIN votes v ON a.id = v.agent_id
    GROUP BY a.id, a.name, a.party_name
    ORDER BY vote_count DESC
";
$stats_result = $conn->query($stats_query);

// Get total votes
$total_votes_query = "SELECT COUNT(*) as total FROM votes";
$total_votes_result = $conn->query($total_votes_query);
$total_votes = $total_votes_result ? $total_votes_result->fetch_assoc()['total'] : 0;

// Get total registered users
$total_users_query = "SELECT COUNT(*) as total FROM details";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result ? $total_users_result->fetch_assoc()['total'] : 0;

// Calculate turnout percentage
$turnout_percentage = $total_users > 0 ? round(($total_votes * 100) / $total_users, 2) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results - Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
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

        /* Animated background */
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

        /* Floating shapes */
        .bg-shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }

        .shape-1 { width: 200px; height: 200px; top: 10%; left: 5%; animation: float 6s ease-in-out infinite; }
        .shape-2 { width: 150px; height: 150px; top: 60%; right: 5%; animation: float 8s ease-in-out infinite reverse; }
        .shape-3 { width: 100px; height: 100px; bottom: 20%; left: 15%; animation: float 7s ease-in-out infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Navbar */
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

        .highlight { color: #facc15; font-weight: 800; }

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

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 1rem;
            text-align: center;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Back button */
        .back-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        /* Statistics cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(31, 38, 135, 0.5);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-weight: 600;
            color: #666;
        }

        /* Color variations for stats */
        .stat-primary { --stat-color: #667eea; }
        .stat-success { --stat-color: #28a745; }
        .stat-warning { --stat-color: #ffc107; }

        .stat-primary .stat-icon, .stat-primary .stat-number { color: var(--stat-color); }
        .stat-success .stat-icon, .stat-success .stat-number { color: var(--stat-color); }
        .stat-warning .stat-icon, .stat-warning .stat-number { color: var(--stat-color); }

        /* Results table */
        .results-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .results-table {
            margin: 0;
        }

        .results-table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            font-weight: 600;
            color: #333;
            padding: 1rem;
        }

        .results-table tbody tr {
            transition: all 0.3s ease;
            border: none;
        }

        .results-table tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.1);
            transform: scale(1.01);
        }

        .results-table td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Voting details table */
        .vote-details-table {
            font-size: 0.9rem;
        }

        .vote-details-table thead th {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
        }

        /* Progress bars for results */
        .vote-progress {
            height: 8px;
            border-radius: 10px;
            background: #e9ecef;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .vote-progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 10px;
            transition: width 1s ease;
        }

        /* Publish button */
        .publish-btn {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            position: relative;
            overflow: hidden;
        }

        .publish-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .publish-btn:disabled {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .published-badge {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        /* Status alerts */
        .status-alert {
            border-radius: 15px;
            border: none;
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }

        .alert-info {
            background: rgba(102, 126, 234, 0.9);
            color: white;
        }

        /* Animation */
        .stat-card, .results-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title { font-size: 2rem; }
            .main-content { margin: 1rem; padding: 1rem; }
            .results-table { font-size: 0.8rem; }
            .stat-number { font-size: 1.5rem; }
            .stat-icon { font-size: 2rem; }
        }

        /* Loading animation */
        .loading {
            animation: pulse 1.5s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            from { opacity: 1; }
            to { opacity: 0.5; }
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
            <a class="navbar-brand text-white" href="admin_dashboard.php">
                Online <span class="highlight">Voting System</span>
            </a>
            <div class="ms-auto">
                <span class="text-white me-3">
                    <i class="bi bi-person-circle me-2"></i><?php echo $_SESSION['admin_name']; ?>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <a href="admin.php" class="back-btn">
            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
        </a>

        <h1 class="page-title">
            <i class="bi bi-bar-chart-fill me-3"></i>Election Results Dashboard
        </h1>
        <p class="page-subtitle">
            Comprehensive voting statistics and detailed results analysis
        </p>

        <!-- Status Alert -->
        <?php if($is_published): ?>
            <div class="alert status-alert alert-success" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <strong>Results Published!</strong> The election results are now public and visible to all users.
            </div>
        <?php else: ?>
            <div class="alert status-alert alert-info" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Results Not Published:</strong> Results are currently private. Click "Publish Results" to make them public.
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-primary h-100">
                    <div class="card-body text-center p-4">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stat-number"><?php echo $total_users; ?></div>
                        <div class="stat-label">Registered Voters</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-success h-100">
                    <div class="card-body text-center p-4">
                        <div class="stat-icon">
                            <i class="bi bi-ballot-fill"></i>
                        </div>
                        <div class="stat-number"><?php echo $total_votes; ?></div>
                        <div class="stat-label">Total Votes Cast</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-warning h-100">
                    <div class="card-body text-center p-4">
                        <div class="stat-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="stat-number"><?php echo $turnout_percentage; ?>%</div>
                        <div class="stat-label">Voter Turnout</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Summary -->
        <div class="card results-card">
            <div class="card-header">
                <i class="bi bi-trophy me-2"></i>Election Results Summary
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table results-table mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-person me-2"></i>Candidate</th>
                                <th><i class="bi bi-flag me-2"></i>Party</th>
                                <th><i class="bi bi-bar-chart me-2"></i>Votes</th>
                                <th><i class="bi bi-percent me-2"></i>Percentage</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($stats_result && $stats_result->num_rows > 0): ?>
                                <?php while($row = $stats_result->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($row['agent_name']); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($row['party_name']); ?></span>
                                        </td>
                                        <td>
                                            <strong class="text-success"><?php echo $row['vote_count']; ?></strong>
                                        </td>
                                        <td>
                                            <strong class="text-primary"><?php echo $row['percentage']; ?>%</strong>
                                        </td>
                                        <td style="width: 200px;">
                                            <div class="vote-progress">
                                                <div class="vote-progress-bar" style="width: <?php echo $row['percentage']; ?>%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                        <p class="text-muted mt-2">No voting data available</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Detailed Voting Records -->
        <div class="card results-card">
            <div class="card-header">
                <i class="bi bi-list-check me-2"></i>Detailed Voting Records
                <span class="badge bg-light text-dark ms-2"><?php echo $total_votes; ?> votes</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table vote-details-table mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-person-circle me-2"></i>Voter</th>
                                <th><i class="bi bi-person-badge me-2"></i>Candidate</th>
                                <th><i class="bi bi-flag me-2"></i>Party</th>
                                <th><i class="bi bi-clock me-2"></i>Vote Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <i class="bi bi-person-check-fill text-success me-2"></i>
                                            <?php echo htmlspecialchars($row['user_name']); ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($row['agent_name']); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?php echo htmlspecialchars($row['party_name']); ?></span>
                                        </td>
                                        <td>
                                            <i class="bi bi-calendar-event me-2"></i>
                                            <?php echo date('M j, Y - g:i A', strtotime($row['vote_time'])); ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                        <p class="text-muted mt-2">No detailed voting records available</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Publish Results Section -->
        <div class="text-center">
            <?php if($is_published): ?>
                <div class="published-badge">
                    <i class="bi bi-check-circle me-2"></i>Results Already Published
                </div>
            <?php else: ?>
                <form method="post" class="d-inline">
                    <button type="submit" name="publish" class="publish-btn" onclick="return confirm('Are you sure you want to publish the results? This action cannot be undone.')">
                        <i class="bi bi-megaphone me-2"></i>Publish Results
                    </button>
                </form>
                <p class="text-white mt-2 small">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Publishing results will make them visible to all users
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

    <script>
       
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.vote-progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });

            
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 15px rgba(102, 126, 234, 0.2)';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.boxShadow = 'none';
                });
            });
        });

        
        <?php if(!$is_published): ?>
        setInterval(function() {
            
            document.body.classList.add('loading');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }, 30000);
        <?php endif; ?>
    </script>
</body>
</html>