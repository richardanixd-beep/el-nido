<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - El Nido Haven</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">El Nido Haven</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn-login">Login</a></li>
                    <li><a href="register.php" class="btn-register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section id="about" class="about-section">
        <h2>About El Nido Haven</h2>
        <p>
            El Nido Haven is a luxurious retreat nestled in the heart of a breathtaking tropical paradise. 
            Offering stunning views, world-class amenities, and authentic local experiences, we are committed 
            to making your stay unforgettable.
        </p>
        <p>
            Located in the picturesque town of El Nido, Palawan, Philippines, our hotel provides direct access 
            to some of the most beautiful beaches and lagoons in the world. Whether you're seeking relaxation, 
            adventure, or a perfect blend of both, El Nido Haven is your ideal destination.
        </p>
        <h3>Our History</h3>
        <p>
            Founded in 2020, El Nido Haven was born from a passion for showcasing the natural beauty of Palawan. 
            Our founders, a group of local entrepreneurs and environmental enthusiasts, envisioned a hotel that 
            not only provides luxury accommodations but also supports sustainable tourism and community development.
        </p>
        <h3>Amenities and Services</h3>
        <ul>
            <li>24/7 concierge service</li>
            <li>On-site restaurant featuring local and international cuisine</li>
            <li>Spa and wellness center</li>
            <li>Guided island hopping tours</li>
            <li>Free Wi-Fi throughout the property</li>
            <li>Swimming pool with ocean views</li>
            <li>Fitness center</li>
            <li>Airport shuttle service</li>
        </ul>
        <h3>Our Commitment</h3>
        <p>
            At El Nido Haven, we are dedicated to preserving the environment and supporting the local community. 
            We partner with local guides, use eco-friendly practices, and contribute to conservation efforts in 
            the area. Your stay with us not only provides comfort and luxury but also helps protect the natural 
            wonders that make El Nido so special.
        </p>
    </section>

    <footer>
        &copy; 2024 El Nido Haven. All rights reserved.
    </footer>
</body>
</html>
