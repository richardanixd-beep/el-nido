-- elnidosai.sql - MySQL database dump for XAMPP import

-- Create database
CREATE DATABASE IF NOT EXISTS elnidosai;
USE elnidosai;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) DEFAULT 'user'
);

-- Create rooms table
CREATE TABLE IF NOT EXISTS rooms (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type VARCHAR(20) NOT NULL,
    description TEXT,
    facilities TEXT,
    services TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255)
);

-- Create bookings table
CREATE TABLE IF NOT EXISTS bookings (
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
);

-- Insert sample admin user
INSERT IGNORE INTO users (username, password, role) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample rooms
INSERT IGNORE INTO rooms (name, type, description, facilities, services, price, image) VALUES
    ('Beachfront Villa', 'Double', 'Enjoy spectacular ocean views and direct beach access.', 'WiFi, AC, Balcony', 'Room service, Laundry', 150.00, 'Big Lagoon, El Nido, Palawan.jpg'),
    ('Garden Cottage', 'Single', 'A peaceful stay surrounded by lush gardens.', 'WiFi, AC, Patio', 'Breakfast, Cleaning', 100.00, 'Hidden Beach, El Nido - El Nido\'s Secret Paradise_ Hidden Beach.jpg'),
    ('Luxury Suite', 'Double', 'Spacious suites offering elegant interiors.', 'WiFi, AC, Mini-bar', 'Spa, Concierge', 200.00, 'El Nido Tour A in Palawan_ Big Lagoon & Shimizu Island.jpg');
