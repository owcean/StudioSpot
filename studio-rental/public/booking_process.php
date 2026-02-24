<?php
session_start();
require 'config.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $comments = isset($_POST['comments']) ? trim($_POST['comments']) : '';

    if (empty($name) || empty($email) || empty($contact_number) || empty($date) || empty($time)) {
        die("All fields are required.");
    }

    try {
        // Insert booking into database
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, name, email, contact_number, date, time, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $name, $email, $contact_number, $date, $time, $comments]);

        // Redirect to bookings page
        header("Location: bookings.php");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    die("Invalid request.");
}
