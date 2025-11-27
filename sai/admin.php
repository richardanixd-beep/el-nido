<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Database connection
$db = new SQLite3('sai.db');

// Handle actions
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_booking'])) {
        $booking_id = $_POST['booking_id'];
        $stmt = $db->prepare("DELETE FROM bookings WHERE id = :id");
        $stmt->bindValue(':id', $booking_id, SQLITE3_INTEGER);
        $stmt->execute();
        $message = "Booking deleted successfully.";
    } elseif (isset($_POST['update_room'])) {
        $room_id = $_POST['room_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stmt = $db->prepare("UPDATE rooms SET name = :name, price = :price WHERE id = :id");
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':price', $price, SQLITE3_FLOAT);
        $stmt->bindValue(':id', $room_id, SQLITE3_INTEGER);
        $stmt->execute();
        $message = "Room updated successfully.";
    }
}

// Fetch data
$bookings = $db->query("SELECT b.*, r.name as room_name, u.username FROM bookings b JOIN rooms r ON b.room_id = r.id JOIN users u ON b.user_id = u.id");
$rooms = $db->query("SELECT * FROM rooms");
$users = $db->query("SELECT id, username, role FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - El Nido Haven</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">El Nido Haven - Admin</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="admin-dashboard">
        <h2>Admin Dashboard</h2>
        <?php if ($message): ?>
            <div class="success-message">
                <p><?php echo htmlspecialchars($message); ?></p>
            </div>
        <?php endif; ?>

        <h3>Bookings</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $bookings->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo htmlspecialchars($booking['username']); ?></td>
                        <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                        <td><?php echo $booking['checkin']; ?></td>
                        <td><?php echo $booking['checkout']; ?></td>
                        <td><?php echo $booking['guests']; ?></td>
                        <td><?php echo $booking['status']; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                <button type="submit" name="delete_booking" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Rooms</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($room = $rooms->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <td><?php echo $room['id']; ?></td>
                        <td><?php echo htmlspecialchars($room['name']); ?></td>
                        <td><?php echo htmlspecialchars($room['type']); ?></td>
                        <td>$<?php echo number_format($room['price'], 2); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                                <input type="text" name="name" value="<?php echo htmlspecialchars($room['name']); ?>" required>
                                <input type="number" name="price" step="0.01" value="<?php echo $room['price']; ?>" required>
                                <button type="submit" name="update_room">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Users</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <footer>
        &copy; 2024 El Nido Haven. All rights reserved.
    </footer>
</body>
</html>
