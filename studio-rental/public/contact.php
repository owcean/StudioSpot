<?php
$title = "Studio Spot";
$email = "StudioSpot@gmail.com";
$location = "Angeles City, 12345";
$phone = "(02) 456-7890";
$footer= "@STUDIOSPOT.PH";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - <?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body class="contact-page">
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

<section class="contact-container">
    <div class="contact-left">
        <img src="img/cover2.png" alt="<?php echo $title; ?>" class="contact-image">
    </div>
    <div class="contact-right">
        <h2>Contact Us</h2>
        <div class="contact-box">
            <form action="process_contact.php" method="POST">
                <label>Name :</label>
                <input type="text" name="name" required>
                <label>Email :</label>
                <input type="email" name="email" required>
                <label>Message :</label>
                <textarea name="message" required></textarea>
                <button type="submit">SEND</button>
            </form>
        </div>
    </div>
    <div class="contact-info-box">
    <p><?php echo $location; ?></p>
    <p><?php echo $phone; ?></p>
    <p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
    <hr> <!-- Line only after Gmail -->
    
    <h3>Business Hours</h3>
    <p>Monday to Friday<br>9:00 am - 6:00 pm</p>
    <p>Saturday<br>9:00 am - 12:00 noon</p>
    <hr> <!-- Line only after schedule -->
    
    <h3>Get Social</h3>
    <div class="contact-social-icons">
        <a href="#"><img src="img/fb.png" alt="Facebook"></a>
        <a href="#"><img src="img/tt.png" alt="Twitter"></a>
        <a href="#"><img src="img/ig.png" alt="Instagram"></a>
    </div>
</div>

<footer> <p><?php echo $footer; ?></p> </footer>


<!-- Include JavaScript for functionality -->
<script defer src="js/script.js"></script>


</body>
</html>
