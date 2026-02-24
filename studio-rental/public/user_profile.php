<?php
require 'db.php'; // Database connection
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details using MySQLi
$query = $mysqli->prepare("SELECT username, role, email FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->bind_result($username, $role, $email);
$query->fetch();
$query->close();

// Assign user details to an array (to match previous structure)
$user = [
    'username' => $username,
    'role' => $role,
    'email' => $email
];

// Fetch bookings made by user
$bookingsQuery = $mysqli->prepare("
    SELECT studios.studio_name, bookings.contact_number, bookings.date, bookings.time, bookings.comments 
    FROM bookings 
    JOIN studios ON bookings.studio_id = studios.id 
    WHERE bookings.user_id = ?");
$bookingsQuery->bind_param("i", $user_id);
$bookingsQuery->execute();
$result = $bookingsQuery->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);
$bookingsQuery->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/dashboard.css"> 
    <link rel="icon" type="image/png" href="img/logo.png">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="user_dashboard.php"><img src="img/logo.png" alt="Studio Spot Logo"></a></li>
            <li><a href="user_dashboard.php"><img src="img/window.png" alt="Dashboard"></a></li>
            <li><a href="bookings.php"><img src="img/bookings.png" alt="Bookings"></a></li>
            <li><a href="user_profile.php"><img src="img/profile.png" alt="Profile"></a></li>
            <li><a href="user_dashboard.php?logout=true"><img src="img/logout.png" alt="Profile"></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Welcome, <?= htmlspecialchars($user['username']) ?>!</h1>
        </header>

        <div class="profile-container">
            <!-- User Information -->
            <div class="profile-info">
                <h2 class="profile-info-user">User Information</h2>
                <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            </div>

            <!-- User Bookings -->
            <div class="profile-bookings">
                <h2>Your Bookings</h2>
                <?php if (!empty($bookings)): ?>
                    <section class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Studio Type</th>
                                    <th>Contact Number</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($booking['studio_name']) ?></td>
                                        <td><?= htmlspecialchars($booking['contact_number']) ?></td>
                                        <td><?= date("F j, Y", strtotime($booking['date'])) ?></td>
                                        <td><?= date("g:i A", strtotime($booking['time'])) ?></td>
                                        <td><?= htmlspecialchars($booking['comments'] ?? 'No comments') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                <?php else: ?>
                    <p>No bookings found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
