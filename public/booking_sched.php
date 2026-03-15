<?php
require 'db.php'; // Database connection

// Add Booking
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_booking"])) {
    $user_id = trim($_POST['user_id']);
    $studio_id = trim($_POST['studio_id']);
    $contact_number = trim($_POST['contact_number']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $comments = trim($_POST['comments']);

    // Validate studio_id (Ensure it's not empty or 0)
    if ($studio_id == '' || $studio_id == '0') {
        die("Error: Invalid Studio Selection.");
    }

    try {
        $sql = "INSERT INTO bookings (user_id, studio_id, contact_number, date, time, comments) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $user_id, $studio_id, $contact_number, $date, $time, $comments);
        $stmt->execute();
        header("Location: booking_sched.php?success=added");
        exit();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

// Delete Booking
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $sql = "DELETE FROM bookings WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: booking_sched.php?success=deleted");
        exit();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

// Fetch Bookings
$search = $_GET['search'] ?? '';
$sql = "SELECT 
            bookings.id,  
            users.username,
            users.email,
            bookings.contact_number,
            bookings.date,
            bookings.time,
            bookings.comments,
            COALESCE(studios.studio_name, 'Unknown Studio') AS studio_name
        FROM bookings
        JOIN users ON bookings.user_id = users.id
        LEFT JOIN studios ON bookings.studio_id = studios.id
        WHERE users.username LIKE ? OR users.email LIKE ?";

$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Schedule</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <nav>
        <ul>
            <li><a href="admin_dashboard.php"><img src="img/logo.png" alt="Studio Spot Logo"></a></li>
            <li><a href="admin_dashboard.php"><img src="img/window.png" alt="Dashboard"></a></li>
            <li><a href="booking_sched.php"><img src="img/bookings.png" alt="Bookings"></a></li>
            <li><a href="admin_profile.php"><img src="img/profile.png" alt="Profile"></a></li>
            <li><a href="logout.php"><img src="img/logout.png" alt="Logout"></a></li>
        </ul>
        </nav>
    </aside>
    <main class="main-content">
        <header><h1>Booking Schedule</h1></header>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET">
                <input type="text" name="search" placeholder="Search by username or email..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Add Booking Form -->
        <div class="add-booking">
            <h3>Add Booking</h3>
            <form method="POST">
                <select name="user_id" required>
                    <option value="">Select User</option>
                    <?php
                    $userQuery = $conn->query("SELECT id, username FROM users");
                    while ($user = $userQuery->fetch_assoc()) {
                        echo "<option value='".htmlspecialchars($user['id'])."'>".htmlspecialchars($user['username'])."</option>";
                    }
                    ?>
                </select>

                <select name="studio_id" required>
                    <option value="">Select Room Type</option>
                    <?php
                    $studioQuery = $conn->query("SELECT id, studio_name FROM studios");
                    while ($studio = $studioQuery->fetch_assoc()) {
                        echo "<option value='".htmlspecialchars($studio['id'])."'>".htmlspecialchars($studio['studio_name'])."</option>";
                    }
                    ?>
                </select>

                <input type="text" name="contact_number" placeholder="Contact Number" required>
                <input type="date" name="date" required>
                <input type="time" name="time" required>
                <textarea name="comments" placeholder="Additional Comments"></textarea>
                <button type="submit" name="add_booking">Add Booking</button>
            </form>
        </div>

        <!-- Booking Table -->
        <section class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Studio Type</th>
                        <th>Contact Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Comments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['username']) ?></td>
                            <td><?= htmlspecialchars($booking['email']) ?></td>
                            <td><?= htmlspecialchars($booking['studio_name']) ?></td>
                            <td><?= htmlspecialchars($booking['contact_number']) ?></td>
                            <td><?= date("F j, Y", strtotime($booking['date'])) ?></td>
                            <td><?= date("g:i A", strtotime($booking['time'])) ?></td>
                            <td><?= htmlspecialchars($booking['comments'] ?? 'No comments') ?></td>
                            <td>
                                <a href="edit_booking.php?id=<?= htmlspecialchars($booking['id']) ?>" class="edit-btn">Edit</a>
                                <a href="booking_sched.php?delete=<?= htmlspecialchars($booking['id']) ?>" class="delete-btn" 
                                onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>
</body>
</html>