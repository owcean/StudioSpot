<?php
require 'db.php'; // Database connection
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch admin details
$query = $conn->prepare("SELECT username, role, email FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Admin not found.");
}

// Fetch bookings made by admin
$bookingsQuery = $conn->prepare("
    
    SELECT users.username, users.email, 
        studios.studio_name, bookings.contact_number, 
        bookings.date, bookings.time, bookings.comments, bookings.id 
    FROM bookings 
    JOIN users ON bookings.user_id = users.id 
    JOIN studios ON bookings.studio_id = studios.id 
    WHERE bookings.user_id = ?
");
$bookingsQuery->bind_param("i", $user_id);
$bookingsQuery->execute();
$bookingsResult = $bookingsQuery->get_result();
$bookings = [];

while ($row = $bookingsResult->fetch_assoc()) {
    $bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="css/admin.css"> 
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="admin_dashboard.php"><img src="img/logo.png" alt="Studio Spot Logo"></a></li>
            <li><a href="admin_dashboard.php"><img src="img/window.png" alt="Dashboard"></a></li>
            <li><a href="booking_sched.php"><img src="img/bookings.png" alt="Bookings"></a></li>
            <li><a href="admin_profile.php"><img src="img/profile.png" alt="Profile"></a></li>
            <li><a href="logout.php"><img src="img/logout.png" alt="Logout"></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Welcome, <?= htmlspecialchars($user['username']) ?>!</h1>
        </header>

        <div class="profile-container">
            <!-- Admin Information -->
            <div class="profile-info">
                <h2>Admin Information</h2>
                <p><strong>USERNAME:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>ROLE:</strong> <?= htmlspecialchars($user['role']) ?></p>
                <p><strong>EMAIL:</strong> <?= htmlspecialchars($user['email']) ?></p>
            </div>

            <!-- Admin Bookings -->
            <div class="profile-bookings">
                <h2>Your Bookings</h2>

                <?php if (!empty($bookings)): ?>
                    <section class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Studio Type</th>
                                    <th>Contact Number</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Comments</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($booking['username']) ?></td>
                                        <td><?= htmlspecialchars($booking['email']) ?></td>
                                        <td><?= htmlspecialchars($booking['studio_name']) ?></td>
                                        <td><?= htmlspecialchars($booking['contact_number']) ?></td>
                                        <td><?= date("F j, Y", strtotime($booking['date'])) ?></td>
                                        <td><?= date("g:i A", strtotime($booking['time'])) ?></td>
                                        <td><?= htmlspecialchars($booking['comments'] ?? 'No comments') ?></td>
                                        <td>
                                            <a href="edit_booking.php?id=<?= htmlspecialchars($booking['id']) ?>" class="edit-btn">Edit</a>
                                            <a href="booking_sched.php?delete=<?= htmlspecialchars($booking['id']) ?>" class="delete-btn" 
                                            onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                                        </td>
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
