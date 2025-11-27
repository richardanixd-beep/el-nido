<?php
session_start();

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else {
        // For now, just set success. In a real app, send email or store in DB.
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - El Nido Haven</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">El Nido Haven</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="rooms.php">Rooms</a></li>
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

    <section id="contact" class="contact-section">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <p><strong>Email:</strong> info@elnidohaven.com</p>
            <p><strong>Phone:</strong> +63 123 456 7890</p>
            <p><strong>Address:</strong> El Nido, Palawan, Philippines</p>
        </div>

        <?php if ($success): ?>
            <div class="success-message">
                <p>Thank you for your message! We will get back to you soon.</p>
            </div>
        <?php else: ?>
            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="contact.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn-contact">Send Message</button>
            </form>
        <?php endif; ?>

        <h3>Our Location</h3>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.764!2d119.4179!3d11.1992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33b5d4c4c4c4c4c4%3A0x4c4c4c4c4c4c4c4c!2sEl%20Nido%2C%20Palawan%2C%20Philippines!5e0!3m2!1sen!2sus!4v1690000000000!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <footer>
        &copy; 2024 El Nido Haven. All rights reserved.
    </footer>
</body>
</html>
