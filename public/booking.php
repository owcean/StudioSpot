<?php
session_start();
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Studio</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    background: url('img/cover3.jpeg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: 'Arial', sans-serif;
}
</style>
<body>
    <div class="booking-container">
        <h1>BOOK YOUR STUDIO!</h1>
        <div class="booking-box">
            <div class="image-section">
                <img src="img/cover.jpg" alt="Studio Image" class="img-booking">
            </div>
            <div class="form-section">
                <form action="booking_process.php" method="POST">
                    <label>Name:</label>
                    <input type="text" name="name" required>

                    <label>Email:</label>
                    <input type="email" name="email" required>

                    <label>Contact Number:</label>
                    <input type="text" name="contact_number" required>

                    <label>Date:</label>
                    <input type="date" name="date" required>

                    <label>Time:</label>
                    <input type="time" name="time" required>

                    <label>More Details:</label>
                    <textarea name="comments" placeholder="I WANT THE DESIGN..."></textarea>

                    <button type="submit" name="submit">BOOK</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
