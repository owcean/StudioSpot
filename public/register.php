<?php
session_start();
require 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = $_POST['role']; // Get the role selection

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful!";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>
    <div class="signup-container">
        <form method="POST">
            <h2>Sign Up</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            
            <label>Username</label>
            <input type="text" name="username" placeholder="JohnDoe" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="hello@example.com" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="********" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="********" required>

            <label>Role</label>
            <select name="role" required>
                <option value="member">Member</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Register</button>
            <a href="login.php" class="login-btn">Back to Login</a>
        </form>
    </div>
</body>
</html>
