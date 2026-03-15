<?php
$title = "Studio Spot - About";
$email = "StudioSpot@gmail.com";
$location = "Angeles City, 12345";
$footer= "@STUDIOSPOT.PH";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ensure this file contains your CSS -->
    <link rel="icon" type="image/png" href="img/logo.png">


</head>
<body class="about-page">
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

<div class="container">
    <h1 class="h1-studio">About Us</h1>
    
    <div class="content-box">
        <h2 class="h2-studio">Welcome to Studio Spot</h2>
        <p>Welcome to <?php echo $title; ?>, your creative space in Angeles City! Designed for photographers, content creators, and brands, our studio offers a professional yet cozy environment where your ideas come to life.</p>
    </div>
    
    <div class="content-box">
        <h2 class="h2-studio">Why Choose Us?</h2>
        <ul>
            <li><strong>Diverse Themed Rooms</strong> – From minimalist aesthetics to vibrant setups, we offer multiple styles to fit your creative needs.</li>
            <li><strong>Customizable Spaces</strong> – Adjust backdrops, props, and lighting to create your ideal setting.</li>
            <li><strong>Prime Location</strong> – Conveniently located in Angeles City, with easy access and parking.</li>
            <li><strong>For Every Creator</strong> – Whether you're a professional photographer, influencer, or brand, our space is designed to inspire.</li>
        </ul>
    </div>
    
    <div class="content-box">
        <h2 class="h2-studio">Let's Create Together!</h2>
        <p>Every great photo tells a story—let <?php echo $title; ?> be the place where you create yours.</p>
        <p><strong>Book Your Session:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
        <p><strong>Visit Us:</strong> <?php echo $location; ?></p>
        <p><strong>Follow Us:</strong> <?php echo $footer; ?></p>
    </div>
</div>

<!-- Include JavaScript for functionality -->
<script defer src="js/script.js"></script>

<footer> <p><?php echo $footer; ?></p> </footer>


</body>
</html>
