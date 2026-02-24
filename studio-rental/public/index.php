<?php 
include "db.php"; 

$title = "Studio Spot";
$footer= "@STUDIOSPOT.PH";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="js/script.js"></script>
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>

    <!-- Header with Always Hamburger Menu -->
    <header>
    <a href="index.php" class="logo">Studio Spot</a>
    <button class="hamburger" id="menu-toggle">&#9776;</button>
    <nav id="nav-menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="studios.php">Studios</a></li>
            <li><a href="login.php">Log In</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
    </nav>
</header>

    <!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Your Studio, Your Story.</h1>
        <div class="line"></div> <!-- Proper line using CSS -->
        <a href="login.php" class="btn">LOG IN / SIGN UP</a>
    </div>
</section>

    <!-- Footer -->
    <footer> <p><?php echo $footer; ?></p> </footer>

</body>
</html>
