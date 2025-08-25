<?php
include 'db_conn.php';
session_start();

// Check if voting is open (date + time)
function checktime(){
    global $conn;
    $check_voting = "SELECT * FROM settings 
                 WHERE id = 1 
                   AND CURDATE() BETWEEN s_date AND e_date
                   AND CURTIME() BETWEEN s_time AND e_time";

$voting_result = mysqli_query($conn, $check_voting);

if (mysqli_num_rows($voting_result) == 0) {
    // Voting not allowed now
    echo "<script>
            alert('Voting is not allowed at this time.');
            window.location.href='dashboard.php';
          </script>";
    exit();
}

}
checktime();


if(!isset($_SESSION['name'])){
    echo "<script> alert('Please login first'); window.location.href='login.php'; </script>";
    exit();
}



$user_id=$_SESSION['user_id'];
$check_vote = "SELECT * FROM votes WHERE user_id = ?";
$stmt = $conn->prepare($check_vote);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$has_voted = $result->num_rows > 0;

if (isset($_POST['vote_submit']) && !$has_voted) {

    //checking if the vote has given within the valid ttime 
    checktime();


    $agent_id = $_POST['agent_id'];
    $user_id  = $_SESSION['user_id'];

   
    $stmt = $conn->prepare("INSERT INTO votes (user_id, agent_id, vote_time) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $agent_id);

    if ($stmt->execute()) {
        echo "<script>
                window.location.href='thanks.php';
              </script>";
    } else {
        echo "<script>
                alert('Error casting vote. Please try again.');
              </script>";
    }

    $stmt->close();
}



$agent_query = "SELECT * FROM agent where status='active' ORDER BY party_name ASC ";
$agent_result = mysqli_query($conn, $agent_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast Your Vote - Online Voting System</title>
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
        .shape-4 { width: 80px; height: 80px; top: 30%; right: 25%; animation: float 5s ease-in-out infinite; }

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

        /* Voting status alerts */
        .voting-alert {
            border-radius: 15px;
            border: none;
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.9);
            color: #333;
        }

        /* Agent cards */
        .agent-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            margin-bottom: 2rem;
            height: 100%;
        }

        .agent-card::before {
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

        .agent-card:hover::before {
            transform: scaleX(1);
        }

        .agent-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(31, 38, 135, 0.5);
        }

        /* Agent photo */
        .agent-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #667eea;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .agent-card:hover .agent-photo {
            transform: scale(1.05);
            border-color: #facc15;
            box-shadow: 0 6px 25px rgba(250, 204, 21, 0.4);
        }

        /* Party symbol */
        .party-symbol {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .agent-card:hover .party-symbol {
            transform: scale(1.1);
            border-color: #667eea;
        }

        /* Agent info */
        .agent-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .party-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .agent-details {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        /* Vote button */
        .vote-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .vote-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .vote-btn:disabled {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .vote-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .vote-btn:hover::before {
            left: 100%;
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

        /* Confirmation modal styling */
        .modal-content {
            border-radius: 20px;
            border: none;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .modal-header {
            border-bottom: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 20px 20px 0 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .modal-title {
            font-weight: 700;
        }

        .btn-close {
            filter: invert(1);
        }

        .confirm-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
        }

        .cancel-btn {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
        }

        /* Animation */
        .agent-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .agent-card:nth-child(1) { animation-delay: 0.1s; }
        .agent-card:nth-child(2) { animation-delay: 0.2s; }
        .agent-card:nth-child(3) { animation-delay: 0.3s; }
        .agent-card:nth-child(4) { animation-delay: 0.4s; }

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
            .agent-photo { width: 100px; height: 100px; }
            .party-symbol { width: 60px; height: 60px; }
        }

        /* No agents message */
        .no-agents {
            text-align: center;
            color: white;
            font-size: 1.2rem;
            padding: 3rem;
        }

        .no-agents i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.7;
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
            <a class="navbar-brand text-white" href="user_dashboard.php">
                Online <span class="highlight">Voting System</span>
            </a>
            <div class="ms-auto">
                <span class="text-white me-3">
                    <i class="bi bi-person-circle me-2"></i><?php echo $_SESSION['name']; ?>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <a href="dashboard.php" class="back-btn">
            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
        </a>

        <h1 class="page-title">
            <i class="bi bi-ballot me-3"></i>Cast Your Vote
        </h1>
        <p class="page-subtitle">
            Choose your preferred candidate by clicking the "Vote" button below their information
        </p>

        <?php if($has_voted): ?>
            <div class="alert voting-alert alert-success" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <strong>Vote Already Cast!</strong> You have successfully voted in this election. Thank you for participating in the democratic process.
            </div>
        <?php else: ?>
            <div class="alert voting-alert alert-warning" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Important:</strong> You can only vote once. Please review all candidates carefully before making your selection.
            </div>
        <?php endif; ?>

        <!-- Agents List -->
        <div class="row">
            <?php if(mysqli_num_rows($agent_result) > 0): ?>
                <?php while($agent = mysqli_fetch_assoc($agent_result)): ?>
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card agent-card h-100">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-4 text-center">
                                        <img src="image/<?php echo $agent['image']; ?>" 
                                             alt="<?php echo $agent['name']; ?>" 
                                             class="agent-photo"
                                             onerror="this.src='image/default-avatar.png'">
                                    </div>
                                    <div class="col-8">
                                        <h4 class="agent-name"><?php echo htmlspecialchars($agent['name']); ?></h4>
                                        <p class="party-name">
                                            <i class="bi bi-flag me-2"></i><?php echo htmlspecialchars($agent['party_name']); ?>
                                        </p>
                                        <p class="agent-details mb-2">
                                            <i class="bi bi-geo-alt me-2"></i><?php echo htmlspecialchars($agent['constituency'] ?? 'Not specified'); ?>
                                        </p>
                                        <p class="agent-details">
                                            <i class="bi bi-person-badge me-2"></i>ID: <?php echo $agent['id']; ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="row mt-3 align-items-center">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <p class="mb-2 fw-semibold">Party Symbol</p>
                                            <img src="image/<?php echo $agent['symbol']; ?>" 
                                                 alt="<?php echo $agent['name']; ?> Symbol" 
                                                 class="party-symbol"
                                                 onerror="this.src='image/default-symbol.png'">
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php if(!$has_voted): ?>
                                            <button type="button" 
                                                    class="vote-btn w-100" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#voteModal"
                                                    data-agent-id="<?php echo $agent['id']; ?>"
                                                    data-agent-name="<?php echo htmlspecialchars($agent['name']); ?>"
                                                    data-party-name="<?php echo htmlspecialchars($agent['party_name']); ?>">
                                                <i class="bi bi-hand-thumbs-up me-2"></i>Vote
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="vote-btn w-100" disabled>
                                                <i class="bi bi-check-circle me-2"></i>Voted
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="no-agents">
                        <i class="bi bi-person-x"></i>
                        <h3>No Candidates Available</h3>
                        <p>There are currently no candidates registered for voting.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Vote Confirmation Modal -->
    <div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voteModalLabel">
                        <i class="bi bi-ballot me-2"></i>Confirm Your Vote
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bi bi-question-circle text-primary" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h5>Are you sure you want to vote for:</h5>
                        <div class="candidate-info mt-3 p-3 bg-light rounded">
                            <h4 id="selectedCandidateName" class="text-primary"></h4>
                            <p id="selectedPartyName" class="text-muted mb-0"></p>
                        </div>
                        <div class="alert alert-warning mt-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Warning:</strong> This action cannot be undone. You can only vote once.
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="POST" style="display: inline;">
                        <input type="hidden" id="confirmAgentId" name="agent_id" value="">
                        <button type="button" class="btn cancel-btn me-3" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i>Cancel
                        </button>
                        <button type="submit" name="vote_submit" class="btn confirm-btn">
                            <i class="bi bi-check-circle me-2"></i>Confirm Vote
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <script>
        // Handle vote confirmation modal
        document.addEventListener('DOMContentLoaded', function() {
            const voteModal = document.getElementById('voteModal');
            const voteButtons = document.querySelectorAll('.vote-btn:not([disabled])');
            
            voteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const agentId = this.getAttribute('data-agent-id');
                    const agentName = this.getAttribute('data-agent-name');
                    const partyName = this.getAttribute('data-party-name');
                    
                    document.getElementById('selectedCandidateName').textContent = agentName;
                    document.getElementById('selectedPartyName').textContent = partyName;
                    document.getElementById('confirmAgentId').value = agentId;
                });
            });

            // Add ripple effect to vote buttons
            voteButtons.forEach(button => {
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