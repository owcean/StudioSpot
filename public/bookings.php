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
    <title>User Dashboard</title>
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

    <h2>Studio Listing</h1>
    <div class="room-container">
        <div class="room-image">
            <img src="img/MINIMALIST 1.jpg" alt="Minimalist White Room">
        </div>
        <div class="room-details">
            <h2>Minimalist White Room</h2>
            <p>Step into a space designed for pure inspiration. Our all-white, minimalist studio is the perfect canvas for your photoshoots, content creation, and creative projects. Whether you’re a photographer, influencer, or brand, our bright, airy aesthetic ensures every shot looks clean, professional, and timeless.</p>
            <a href="minimalist.php"><button class="more-info">MORE INFO</button></a>
        </div>
    </div>
    <div class="room-container">
        <div class="room-image">
            <img src="img/boho 2.jpg" alt="Boho Cozy Space">
        </div>
        <div class="room-details">
            <h2>Boho Cozy Space</h2>
            <p>Designed for headshots, executive branding, and polished content creation, our Corporate Studio offers a sleek, modern backdrop that elevates your professional image. With premium lighting and a refined atmosphere, it's the ideal space for business portraits, team shoots, and corporate campaigns.</p>
            <a href="boho.php"><button class="more-info">MORE INFO</button></a>

        </div>
    </div>
    <div class="room-container">
        <div class="room-image">
            <img src="img/corpo 3.jpg" alt="Corporate Studio">
        </div>
        <div class="room-details">
            <h2>Corporate Studio</h2>
            <p>Surround yourself with earthy tones, soft textures, and dreamy natural light. Our Boho Cozy Studio is designed for intimate photoshoots, lifestyle content, and creative storytelling. Whether you’re capturing soulful portraits or laid-back brand aesthetics, this space brings warmth, charm, and effortless beauty to every frame.</p>
            <a href="corpo.php"><button class="more-info">MORE INFO</button></a>
        </div>
    </div>
    <div class="room-container">
        <div class="room-image">
            <img src="img/custom5.jpg" alt="Customize Setup">
        </div>
        <div class="room-details">
            <h2>Customize Setup</h2>
            <p>Need a space that fits your unique style? Our Custom Studio Setup lets you transform the space to match your creative needs. Whether it’s a themed shoot, a personalized brand setup, or a special occasion, we’ll help you craft the perfect atmosphere. From minimal and modern to warm and whimsical, the possibilities are endless!</p>
            <a href="custom.php"><button class="more-info">MORE INFO</button></a>        
    </div>
    </div>
</body>
</html>