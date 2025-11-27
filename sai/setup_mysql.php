<?php
// setup_mysql.php - Create elnidosai MySQL database and tables

$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS elnidosai";
if ($conn->query($sql) === TRUE) {
    echo "Database elnidosai created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Select database
$conn->select_db("elnidosai");

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) DEFAULT 'user'
)";
if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully\n";
} else {
    echo "Error creating table users: " . $conn->error . "\n";
}

// Create rooms table
$sql = "CREATE TABLE IF NOT EXISTS rooms (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type VARCHAR(20) NOT NULL,
    description TEXT,
    facilities TEXT,
    services TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table rooms created successfully\n";
} else {
    echo "Error creating table rooms: " . $conn->error . "\n";
}

// Create bookings table
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    room_id INT(6) UNSIGNED NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    guests INT(2) NOT NULL,
    payment_method VARCHAR(20) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table bookings created successfully\n";
} else {
    echo "Error creating table bookings: " . $conn->error . "\n";
}

// Insert sample admin user
$sql = "INSERT IGNORE INTO users (username, password, role) VALUES ('admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'admin')";
if ($conn->query($sql) === TRUE) {
    echo "Sample admin user inserted successfully\n";
} else {
    echo "Error inserting admin user: " . $conn->error . "\n";
}

// Insert sample rooms
$sql = "INSERT IGNORE INTO rooms (name, type, description, facilities, services, price, image) VALUES
    ('Beachfront Villa', 'Double', 'Enjoy spectacular ocean views and direct beach access.', 'WiFi, AC, Balcony', 'Room service, Laundry', 150.00, 'Big Lagoon, El Nido, Palawan.jpg'),
    ('Garden Cottage', 'Single', 'A peaceful stay surrounded by lush gardens.', 'WiFi, AC, Patio', 'Breakfast, Cleaning', 100.00, 'Hidden Beach, El Nido - El Nido\'s Secret Paradise_ Hidden Beach.jpg'),
    ('Luxury Suite', 'Double', 'Spacious suites offering elegant interiors.', 'WiFi, AC, Mini-bar', 'Spa, Concierge', 200.00, 'El Nido Tour A in Palawan_ Big Lagoon & Shimizu Island.jpg')";
if ($conn->query($sql) === TRUE) {
    echo "Sample rooms inserted successfully\n";
} else {
    echo "Error inserting rooms: " . $conn->error . "\n";
}

$conn->close();
echo "MySQL database elnidosai setup completed.\n";
?>
