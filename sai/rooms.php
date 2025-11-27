<?php
session_start();

// Database connection
$db = new SQLite3('sai.db');

// Fetch all rooms
$rooms = $db->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms - El Nido Haven</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">El Nido Haven</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#rooms">Rooms</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn-login">Login</a></li>
                    <li><a href="register.php" class="btn-register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section id="rooms" class="rooms-section">
        <h2>Our Rooms</h2>
        <div class="rooms-grid">
            <?php while ($room = $rooms->fetchArray(SQLITE3_ASSOC)): ?>
                <div class="room-card">
                    <img src="<?php echo htmlspecialchars($room['image']); ?>" alt="<?php echo htmlspecialchars($room['name']); ?>" />
                    <h3><?php echo htmlspecialchars($room['name']); ?></h3>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($room['type']); ?></p>
                    <p><?php echo htmlspecialchars($room['description']); ?></p>
                    <p><strong>Facilities:</strong> <?php echo htmlspecialchars($room['facilities']); ?></p>
                    <p><strong>Services:</strong> <?php echo htmlspecialchars($room['services']); ?></p>
                    <p class="price">$<?php echo number_format($room['price'], 2); ?> per night</p>
                    <a href="booking.php?room_id=<?php echo $room['id']; ?>" class="btn-book">Book Now</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <footer>
        &copy; 2024 El Nido Haven. All rights reserved.
    </footer>
</body>
</html>
