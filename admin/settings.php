<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Settings Dashboard</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .settings-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .settings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .card-title {
            font-size: 1.3em;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .checkbox-label {
            color: #555;
            font-size: 14px;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 140px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #dee2e6;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .status-indicator {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-scheduled {
            background: #fff3cd;
            color: #856404;
        }

        .info-box {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }

        .info-box p {
            color: #0066cc;
            font-size: 14px;
            margin: 0;
        }

        .danger-zone {
            border: 2px solid #dc3545;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .danger-zone h3 {
            color: #dc3545;
            margin-bottom: 15px;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        @media (max-width: 768px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
            }

            .header h1 {
                font-size: 2em;
            }
        }
    </style>


<?php
include '../db_conn.php';

$sel="select * from settings";
$run1=mysqli_query($conn, $sel) or die("query unsuccessful!");
$row=mysqli_fetch_assoc($run1);
?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚙️ Voting Settings Dashboard</h1>
            <p>Configure and manage your voting system parameters</p>
        </div>

        <div class="settings-grid">
            <!-- Voting Schedule Card -->
            <div class="settings-card">
                <div class="card-title">
                    <div class="card-icon">📅</div>
                    Voting Schedule
                </div>
                
                <div class="form-group">
                    <label>Voting Status</label>
                    <div style="margin-bottom: 15px;">
                        <span id="voting-status" class="status-indicator status-scheduled">Scheduled</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="voting-s-date">Voting Date</label>
                    <input type="date" id="voting-s-date" class="form-control"  value="<?php echo $row['s_date'] ?>">
                </div>
                <div class="form-group">
                    <label for="voting-e-date">Voting Date</label>
                    <input type="date" id="voting-e-date" class="form-control"  value="<?php echo $row['e_date'] ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="start-time">Start Time</label>
                        <input type="time" id="start-time" class="form-control"  value="<?php echo $row['s_time'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="end-time">End Time</label>
                        <input type="time" id="end-time" class="form-control"  value="<?php echo $row['e_time'] ?>">
                    </div>
                </div>

               
            </div>

            <!-- Voting Rules Card -->
            <div class="settings-card">
                <div class="card-title">
                    <div class="card-icon">📋</div>
                    Voting Rules & Limits
                </div>

                <div class="form-group">
                    <label for="max-votes">Maximum Votes per Voter</label>
                    <input type="number" id="max-votes" class="form-control" value="1" min="1" max="10" readonly>
                </div>

                <div class="form-group">
                    <label for="min-age">Minimum Voter Age</label>
                    <input type="number" id="min-age" class="form-control" value="18" min="16" max="25">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="require-verification" class="checkbox" checked disabled>
                    <label for="require-verification" class="checkbox-label">Require voter verification</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="allow-early-voting" class="checkbox" disabled>
                    <label for="allow-early-voting" class="checkbox-label">Allow early voting</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="anonymous-voting" class="checkbox" checked disabled>
                    <label for="anonymous-voting" class="checkbox-label">Anonymous voting</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="show-live-results" class="checkbox" disabled>
                    <label for="show-live-results" class="checkbox-label">Show live results during voting</label>
                </div>
            </div>

            <!-- Notifications Card -->
            <div class="settings-card">
                <div class="card-title">
                    <div class="card-icon">🔔</div>
                    Notifications & Reminders
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="email-notifications" class="checkbox" checked>
                    <label for="email-notifications" class="checkbox-label">Email notifications</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="sms-notifications" class="checkbox">
                    <label for="sms-notifications" class="checkbox-label">SMS notifications</label>
                </div>

                <div class="form-group">
                    <label for="reminder-hours">Send reminders (hours before voting)</label>
                    <select id="reminder-hours" class="form-control">
                        <option value="1">1 hour before</option>
                        <option value="2">2 hours before</option>
                        <option value="6">6 hours before</option>
                        <option value="12">12 hours before</option>
                        <option value="24" selected>24 hours before</option>
                        <option value="48">48 hours before</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="notification-message">Custom notification message</label>
                    <textarea id="notification-message" class="form-control" rows="3" placeholder="Enter custom message for voter notifications...">Don't forget to cast your vote! The voting period ends soon.</textarea>
                </div>
            </div>

            <!-- Security & Access Card -->
            <div class="settings-card">
                <div class="card-title">
                    <div class="card-icon">🔒</div>
                    Security & Access Control
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="two-factor-auth" class="checkbox">
                    <label for="two-factor-auth" class="checkbox-label">Require two-factor authentication</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="ip-restriction" class="checkbox">
                    <label for="ip-restriction" class="checkbox-label">IP address restrictions</label>
                </div>

                <div class="form-group">
                    <label for="session-timeout">Session timeout (minutes)</label>
                    <select id="session-timeout" class="form-control">
                        <option value="15">15 minutes</option>
                        <option value="30" selected>30 minutes</option>
                        <option value="60">1 hour</option>
                        <option value="120">2 hours</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="backup-frequency">Backup frequency</label>
                    <select id="backup-frequency" class="form-control">
                        <option value="hourly">Every hour</option>
                        <option value="daily" selected>Daily</option>
                        <option value="weekly">Weekly</option>
                    </select>
                </div>

                <div class="info-box">
                    <p><strong>Security Note:</strong> All votes are encrypted and stored securely. Access logs are maintained for audit purposes.</p>
                </div>
            </div>

            <!-- Results & Reporting Card -->
            <div class="settings-card">
                <div class="card-title">
                    <div class="card-icon">📊</div>
                    Results & Reporting
                </div>

                <div class="form-group">
                    <label for="results-visibility">Results visibility</label>
                    <select id="results-visibility" class="form-control" disabled>
                        <option value="immediate">Show immediately after voting ends</option>
                        <option value="scheduled" >Show at scheduled time</option>
                        <option value="manual" selected >Show manually by admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="results-date">Results publication date</label>
                    <input type="date" id="results-date" class="form-control"  value="<?php echo $row['pub_date'] ?>">
                </div>

                <div class="form-group">
                    <label for="results-time">Results publication time</label>
                    <input type="time" id="results-time" class="form-control"  value="<?php echo $row['pub_time'] ?>">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="detailed-analytics" class="checkbox" checked disabled>
                    <label for="detailed-analytics" class="checkbox-label">Generate detailed analytics</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="export-results" class="checkbox" checked disabled>
                    <label for="export-results" class="checkbox-label">Allow results export</label>
                </div>
            </div>

            <!-- System Maintenance Card -->
            <div class="settings-card">
                <div class="card-title">
                    <div class="card-icon">🔧</div>
                    System Maintenance
                </div>

                <div class="form-group">
                    <label for="maintenance-window">Maintenance window</label>
                    <select id="maintenance-window" class="form-control" disabled>
                        <option value="none" selected>No scheduled maintenance</option>
                        <option value="daily">Daily (2:00 AM - 3:00 AM)</option>
                        <option value="weekly">Weekly (Sunday 1:00 AM - 2:00 AM)</option>
                    </select>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="auto-updates" class="checkbox" checked disabled>
                    <label for="auto-updates" class="checkbox-label">Enable automatic system updates</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="performance-monitoring" class="checkbox" checked disabled>
                    <label for="performance-monitoring" class="checkbox-label">Enable performance monitoring</label>
                </div>

                <div class="danger-zone">
                    <h3>⚠️ Danger Zone</h3>
                    <p style="margin-bottom: 15px; color: #666;">These actions cannot be undone. Please proceed with caution.</p>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-danger" onclick="resetAllSettings()">Reset All Settings</button>
                        <button class="btn btn-danger" onclick="clearAllVotes()">Clear All Votes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="button-group">
            <button class="btn btn-primary" onclick="saveSettings()">💾 Save All Settings</button>
            <!-- <button class="btn btn-secondary" onclick="previewSettings()">👁️ Preview Changes</button> -->
            <button class="btn btn-secondary" onclick="goBack()">← Back to Dashboard</button>
        </div>
    </div>

    <script>
        // Initialize settings from saved data or defaults
        function loadSettings() {
            // In a real application, this would load from a backend API
            console.log('Loading settings...');
            updateVotingStatus();
        }

        // Update voting status based on current date/time
        function updateVotingStatus() {
            const statusElement = document.getElementById('voting-status');
            const votingsDate = document.getElementById('voting-s-date').value;
            const votingeDate = document.getElementById('voting-e-date').value;
            const startTime = document.getElementById('start-time').value;
            const endTime = document.getElementById('end-time').value;
            
            const now = new Date();
            const votingStart = new Date(`${votingsDate} ${startTime}`);
            const votingEnd = new Date(`${votingeDate} ${endTime}`);
            
            if (now < votingStart) {
                statusElement.textContent = 'Scheduled';
                statusElement.className = 'status-indicator status-scheduled';
            } else if (now >= votingStart && now <= votingEnd) {
                statusElement.textContent = 'Active';
                statusElement.className = 'status-indicator status-active';
            } else {
                statusElement.textContent = 'Ended';
                statusElement.className = 'status-indicator status-inactive';
            }
        }

        // Save all settings
        function saveSettings() {
            const settings = {
                votingsDate: document.getElementById('voting-s-date').value,
                 votingeDate: document.getElementById('voting-e-date').value,
                startTime: document.getElementById('start-time').value,
                endTime: document.getElementById('end-time').value,
                maxVotes: document.getElementById('max-votes').value,
                minAge: document.getElementById('min-age').value,
                requireVerification: document.getElementById('require-verification').checked,
                allowEarlyVoting: document.getElementById('allow-early-voting').checked,
                anonymousVoting: document.getElementById('anonymous-voting').checked,
                showLiveResults: document.getElementById('show-live-results').checked,
                emailNotifications: document.getElementById('email-notifications').checked,
                smsNotifications: document.getElementById('sms-notifications').checked,
                reminderHours: document.getElementById('reminder-hours').value,
                notificationMessage: document.getElementById('notification-message').value,
                twoFactorAuth: document.getElementById('two-factor-auth').checked,
                ipRestriction: document.getElementById('ip-restriction').checked,
                sessionTimeout: document.getElementById('session-timeout').value,
                backupFrequency: document.getElementById('backup-frequency').value,
                resultsVisibility: document.getElementById('results-visibility').value,
                resultsDate: document.getElementById('results-date').value,
                resultsTime: document.getElementById('results-time').value,
                detailedAnalytics: document.getElementById('detailed-analytics').checked,
                exportResults: document.getElementById('export-results').checked,
                maintenanceWindow: document.getElementById('maintenance-window').value,
                autoUpdates: document.getElementById('auto-updates').checked,
                performanceMonitoring: document.getElementById('performance-monitoring').checked
            };
            
            fetch('save_settings.php', {   
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(settings)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response:', data);
                alert('Settings saved successfully! ✅');
                updateVotingStatus();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to save settings ❌');
            });
        }

        // Preview settings
        // function previewSettings() {
        //     alert('Preview mode would show how the voting system would look with these settings.');
        // }

        // Reset all settings
        function resetAllSettings() {
            if (confirm('Are you sure you want to reset all settings to defaults? This action cannot be undone.')) {
                alert('All settings have been reset to defaults.');
                updateVotingStatus();
                location.reload(); 
                
            }
        }

        // Clear all votes
        function clearAllVotes() {
            if (confirm('Are you sure you want to clear ALL votes? This action cannot be undone and will permanently delete all voting data.')) {
                if (confirm('This is your final warning. All votes will be permanently deleted. Are you absolutely sure?')) {
                    fetch('clear_votes.php', {
                        method: 'POST'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Something went wrong!");
                    });

                }
            }
        }

        // Go back to previous page
        function goBack() {
            window.history.back();
        }

        // Add event listeners for real-time status updates
        document.getElementById('voting-s-date').addEventListener('change', updateVotingStatus);
        document.getElementById('voting-e-date').addEventListener('change', updateVotingStatus);
        document.getElementById('start-time').addEventListener('change', updateVotingStatus);
        document.getElementById('end-time').addEventListener('change', updateVotingStatus);

        // Validate time inputs
        function validateTimes() {
            const startTime = document.getElementById('start-time').value;
            const endTime = document.getElementById('end-time').value;
            
            if (startTime && endTime && startTime >= endTime) {
                alert('End time must be after start time!');
                return false;
            }
            return true;
        }

        document.getElementById('start-time').addEventListener('change', validateTimes);
        document.getElementById('end-time').addEventListener('change', validateTimes);

        // Load settings on page load
        document.addEventListener('DOMContentLoaded', loadSettings);

        // Auto-save functionality (saves every 30 seconds if changes detected)
        let settingsChanged = false;
        let autoSaveInterval;

        function markSettingsChanged() {
            settingsChanged = true;
        }

        function startAutoSave() {
            autoSaveInterval = setInterval(() => {
                if (settingsChanged) {
                    console.log('Auto-saving settings...');
                    // In a real app, you might want to save silently
                    settingsChanged = false;
                }
            }, 30000); // 30 seconds
        }

        // Add change listeners to all form inputs
        document.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('change', markSettingsChanged);
        });

        // Start auto-save on page load
        document.addEventListener('DOMContentLoaded', startAutoSave);
    </script>
</body>
</html>