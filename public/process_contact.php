<?php
session_start();
require '../includes/config.php'; // Correct path for database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
        exit;
    }

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $query = $conn->prepare("INSERT INTO contacts (user_id, name, email, message) VALUES (?, ?, ?, ?)");
    $query->execute([$user_id, $name, $email, $message]);

    header("Location: contact.php?success=1");
    exit;
} else {
    header("Location: contact.php");
    exit;
}
