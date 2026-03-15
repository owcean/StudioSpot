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

// Sample studio data (You should fetch this from the database)
$studios = [
    ["image" => "img/minimalist.jpg", "name" => "Minimalist White Room", "id" => 1],
    ["image" => "img/boho 4.jpg", "name" => "Boho Cozy Space", "id" => 2],
    ["image" => "img/corpo 2.jpg", "name" => "Corporate Studio", "id" => 3],
    ["image" => "img/custom1.jpg", "name" => "Custom Setup", "id" => 4],
];


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
            <li><a href="user_dashboard.php"><img src="img/window.png" alt="Dashboard"></a></li>
            <li><a href="bookings.php"><img src="img/bookings.png" alt="Bookings"></a></li>
            <li><a href="user_profile.php"><img src="img/profile.png" alt="Profile"></a></li>
            <li><a href="user_dashboard.php?logout=true"><img src="img/logout.png" alt="Profile"></a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Hi, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        </header>

        <section class="studio-intro">
            <h1>Your Studio, Your Story</h1>
            <p>Stay on top of your bookings with ease. Check your upcoming sessions, review past shoots, 
            and get ready for your next creative moment. Whether you're planning a shoot or just counting 
            down the days, your studio experience starts here.</p>
            <a href="bookings.php" class="book-btn">BOOK NOW!</a>
        </section>

        <section class="studio-list">
            <?php foreach ($studios as $studio): ?>
                <div class="studio-card">
                    <a href="studio_details.php?id=<?= $studio['id']; ?>">
                        <img src="<?= $studio['image']; ?>" alt="<?= htmlspecialchars($studio['name']); ?>">
                        <h3><?= htmlspecialchars($studio['name']); ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</body>
</html>
