<?php 
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use $mysqli if db.php defines it
    $stmt = $mysqli->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role; // Store role in session

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "User not found!";
    }
    $stmt->close();
}

$footer = "@STUDIOSPOT.PH";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <p>Sign in to continue</p>

            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="hello@reallygreatsite.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <button type="submit">Log in</button>
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </form>

        </div>
    </div>

    <footer> <p><?php echo $footer; ?></p> </footer>

</body>
</html>
