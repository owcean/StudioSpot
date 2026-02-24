<?php 
// studios.php 
$title = "Studio Spot - Studios";
$contact_email = "StudioSpot@gmail.com";
$website = "www.StudioSpot.com";
$hourly_rate = "1,000 Pesos";
$contact_info = "09994899536";

$footer= "@STUDIOSPOT.PH";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styles.css"> 
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body class="studio-page">
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
    <h1 class="h1-studio">Studio Listing</h1>
    
    <div class="studio-list">
        <?php 
        $studios = [
            ["image" => "img/MINIMALIST 1.jpg", "alt" => "Minimalist White Room", "name" => "Minimalist White Room"],
            ["image" => "img/boho 1.jpg", "alt" => "Boho Cozy Space", "name" => "Boho Cozy Space"],
            ["image" => "img/corpo 1.jpg", "alt" => "Corporate Studio", "name" => "Corporate Studio"],
            ["image" => "img/customize page.jfif", "alt" => "Custom Setup", "name" => "Custom Setup"]
        ];

        foreach ($studios as $studio) {
            echo '<div class="studio-item">
                    <img src="' . $studio["image"] . '" alt="' . $studio["alt"] . '" onclick="openFullScreen(this)">
                    <h3 class="h3-studio">' . $studio["name"] . '</h3>
                  </div>';
        }
        ?>
    </div>
    
    <div class="content-box">
        <h2 class="h2-studio">Studio Features</h2>
        <ul>
            <?php 
            $features = [
                "Multiple themed rooms with unique aesthetics",
                "Customizable backdrops and props",
                "Professional lighting setup available",
                "Spacious and comfortable environment",
                "Air-conditioned space for a smooth shoot",
                "Easy access and parking"
            ];

            foreach ($features as $feature) {
                echo "<li>$feature</li>";
            }
            ?>
        </ul>
    </div>
    
    <div class="content-box">
        <h2 class="h2-studio">Rates & Booking</h2>
        <p><strong>Hourly Rate:</strong> Starts at <?php echo $hourly_rate; ?></p>
        <p><strong>Availability:</strong> Open daily, book in advance</p>
        <p><strong>How to Book:</strong> Contact us via <strong><?php echo $contact_email; ?></strong> or visit <a href="#"><?php echo $website; ?></a></p>
        <p><strong>For inquiries, call/message:</strong> <?php echo $contact_info; ?></p>
    </div>
</div>

<!-- Fullscreen Image Container -->
<div id="fullscreen-container" onclick="closeFullScreen()">
    <img id="fullscreen-image" src="">
</div>

<style>
/* Fullscreen Image Styling */
#fullscreen-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    text-align: center;
    z-index: 1000;
}

#fullscreen-image {
    max-width: 90%;
    max-height: 90%;
    margin-top: 5%;
}
</style>

<script>
function openFullScreen(img) {
    document.getElementById('fullscreen-image').src = img.src;
    document.getElementById('fullscreen-container').style.display = 'block';
}

function closeFullScreen() {
    document.getElementById('fullscreen-container').style.display = 'none';
}
</script>

<!-- Include JavaScript for functionality -->
<script defer src="js/script.js"></script>

<footer> <p><?php echo $footer; ?></p> </footer>


</body>
</html>
