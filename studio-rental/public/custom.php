<?php
session_start();
require 'config.php'; // Ensure the correct path to config.php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    // Fetch user details from the database
    $user_id = $_SESSION['user_id'];
    $query = "SELECT username, email FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found in the database.");
    }
} catch (PDOException $e) {
    die("Error fetching user details: " . $e->getMessage());
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Setup</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="user_dashboard.php"><img src="img/logo.png" alt="Studio Spot Logo"></a></li>
            <li><a href="user_dashboard.php"><img src="img/window.png" alt="Messages"></a></li>
            <li><a href="bookings.php"><img src="img/bookings.png" alt="Messages"></a></li>
            <li><a href="user_profile.php"><img src="img/profile.png" alt="Messages"></a></li>
            <li><a href="user_dashboard.php?logout=true"><img src="img/logout.png" alt="Profile"></a></li>
        </ul>
    </div>
    <div class="main-content">
    <header>
            <h1>Hi, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        </header>
        <div class="content-box">
            <h1 class="title">Customize Setup</h1>
            <div class="image-gallery">
                <img src="img/custom1.jpg" alt="Room Image 1">
                <img src="img/custom2.jpg" alt="Room Image 2">
                <img src="img/custom3.jpg" alt="Room Image 3">
                <img src="img/custom4.jpg" alt="Room Image 4">
                <img src="img/custom5.jpg" alt="Room Image 4" class="img-noshow">
            </div>
            
            <div class="rates-details">
                <div class="rates">
                    <h2 class="title-box">Rates</h2>
                    <div class="rate-container">
                        <div class="weekdays">
                            <h3>Weekdays</h3>
                            <p>Php 1,500 per hour VAT inc.<br>Minimum of 6 hours<br>Maximum of 12 hours</p>
                        </div>
                        <div class="weekends">
                            <h3>Weekends</h3>
                            <p>Php 2,000 per hour VAT inc.<br>Minimum of 6 hours<br>Maximum of 12 hours</p>
                        </div>
                    </div>
                </div>
                <div class="studio-details">
                    <h2 class="title-box">Studio Details</h2>
                    <div class="studio-container">
                        <div class="left-details">
                            <p><strong>Area:</strong> 90 sqm.</p>
                            <p><strong>WiFi:</strong> Yes</p>
                            <p><strong>Client Area:</strong> 15 sqm</p>
                            <p><strong>Shooting Area:</strong> 25-30 sqm</p>
                        </div>
                        <div class="right-details">
                            <p>2 Foldable tables</p>
                            <p>15 Monoblock chairs</p>
                            <p>Sofa</p>
                            <p>Makeup Area</p>
                            <p>Own Restroom</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Book Now Button (Redirects to Booking Page) -->
            <a href="booking.php" class="book-btn">Book Now</a>
        </div>
        
        <footer>
            <p class="contact">&copy; 2025 Studio Spot | @STUDIORENTAL.PH</p>
        </footer>
    </div>
</body>
</html>
