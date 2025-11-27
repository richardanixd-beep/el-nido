<?php
session_start();

// Database connection
$db = new SQLite3('sai.db');

// Fetch featured rooms
$rooms = $db->query("SELECT * FROM rooms LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>El Nido Haven - Your Tropical Paradise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">El Nido Haven</div>
    <nav>
        <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#accommodations">Accommodations</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login.php" class="btn-login">Login</a></li>
            <li><a href="register.php" class="btn-register">Register</a></li>
        </ul>
    </nav>
</header>

<section id="hero" class="hero">
    <h1>Welcome to El Nido Haven</h1>
    <p>Your tropical paradise awaits. Experience the serene beauty and vibrant culture in one place.</p>
</section>

<section id="about" class="about">
    <h2>About El Nido Haven</h2>
    <p>
        El Nido Haven is a luxurious retreat nestled in the heart of a breathtaking tropical paradise. 
        Offering stunning views, world-class amenities, and authentic local experiences, we are committed 
        to making your stay unforgettable.
    </p>
</section>

<section id="accommodations" class="accommodations">
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

<!-- ✅ EL NIDO REALISTIC GALLERY -->
<section id="gallery" class="gallery">
    <h2>Gallery - Best of El Nido Palawan</h2>

    <img src="Big Lagoon, El Nido, Palawan.jpg" alt="El Nido Lagoon" />
    <img src="Helicopter Island (Dilumicad) in El Nido, Palawan - Explore with Tikigo.jpg" alt="El Nido Islands" />
    <img src="El Nido Tour A in Palawan_ Big Lagoon & Shimizu Island.jpg" alt="El Nido Beach" />
    <img src="Hidden Beach, El Nido - El Nido's Secret Paradise_ Hidden Beach.jpg" alt="Limestone Cliffs" />
    <img src="Sunset Lio Beach El Nido.jpg" alt="El Nido Sunset" />
    <img src="El Nido.jpg" alt="Island Hopping Boat" />
</section>

<section id="contact" class="contact-info">
    <h2>Contact Us</h2>
    <p>Email: info@elnidohaven.com</p>
    <p>Phone: +63 123 456 7890</p>
    <p>Address: El Nido, Palawan, Philippines</p>
</section>

<footer>
    &copy; 2024 El Nido Haven. All rights reserved.
</footer>

</body>
</html>
