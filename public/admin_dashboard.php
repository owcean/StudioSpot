<?php
session_start();
require 'db.php'; // Ensure the database connection is included

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch studio count
$stmt = $conn->prepare("SELECT COUNT(*) FROM studios");
$stmt->execute();
$stmt->bind_result($studio_count);
$stmt->fetch();
$stmt->close();

// Fetch booking count
$stmt = $conn->prepare("SELECT COUNT(*) FROM bookings");
$stmt->execute();
$stmt->bind_result($booking_count);
$stmt->fetch();
$stmt->close();

// Fetch user count
$stmt = $conn->prepare("SELECT COUNT(*) FROM users");
$stmt->execute();
$stmt->bind_result($user_count);
$stmt->fetch();
$stmt->close();

// Fetch admin user data
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

// Store username in an array (to match previous variable usage)
$user = ['username' => $username];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>

<div class="sidebar">
        <ul>
            <li><a href="admin_dashboard.php"><img src="img/logo.png" alt="Studio Spot Logo"></a></li>
            <li><a href="admin_dashboard.php"><img src="img/window.png" alt="Messages"></a></li>
            <li><a href="booking_sched.php"><img src="img/bookings.png" alt="Messages"></a></li>
            <li><a href="admin_profile.php"><img src="img/profile.png" alt="Messages"></a></li>
            <li><a href="user_dashboard.php?logout=true"><img src="img/logout.png" alt="Logout"></a></li>
        </ul>
    </div>
    <div class="main-content">
    <header>
        <h1>Hi, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        
    </header>

        <div class="dashboard-cards">
            <div class="card">
                <div>
                    <h2><?php echo $studio_count; ?></h2>
                    <p>Studio Types</p>
                </div>
            </div>

            <div class="card">
                <div>
                    <h2><?php echo $booking_count; ?></h2>
                    <p>New Bookings</p>
                </div>
            </div>

            <div class="card">
                <div>
                    <h2><?php echo $user_count; ?></h2>
                    <p>Users</p>
                </div>
            </div>
            </div>
        <div class="charts">
            <canvas id="earningsChart"></canvas>
            <canvas id="bookingsChart"></canvas>
        </div>
    </div>

    <script>
        const ctx1 = document.getElementById('earningsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: { labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'], datasets: [{ label: 'Earnings', data: [20, 25, 35, 40], borderColor: 'brown', fill: false }] },
            options: { responsive: true }
        });

        const ctx2 = document.getElementById('bookingsChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: { labels: ['Room 1', 'Room 2', 'Room 3', 'Room 4'], datasets: [{ label: 'Bookings', data: [8, 12, 20, 15], backgroundColor: ['#a07c5b', '#7d6654', '#5c4d3b', '#40342d'] }] },
            options: { responsive: true }
        });
    </script>
</body>
</html>