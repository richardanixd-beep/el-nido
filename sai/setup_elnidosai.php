<?php
// setup_elnidosai.php - Create elnidosai.db SQLite database and tables

$db = new SQLite3('elnidosai.db');

// Create users table
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'user'
)");

// Create rooms table
$db->exec("CREATE TABLE IF NOT EXISTS rooms (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    type TEXT NOT NULL,
    description TEXT,
    facilities TEXT,
    services TEXT,
    price REAL NOT NULL,
    image TEXT
)");

// Create bookings table
$db->exec("CREATE TABLE IF NOT EXISTS bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    room_id INTEGER NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    guests INTEGER NOT NULL,
    payment_method TEXT NOT NULL,
    status TEXT DEFAULT 'pending',
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(room_id) REFERENCES rooms(id)
)");

// Insert sample admin user
$db->exec("INSERT OR IGNORE INTO users (username, password, role) VALUES ('admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'admin')");

// Insert sample rooms
$db->exec("INSERT OR IGNORE INTO rooms (name, type, description, facilities, services, price, image) VALUES
    ('Beachfront Villa', 'Double', 'Enjoy spectacular ocean views and direct beach access.', 'WiFi, AC, Balcony', 'Room service, Laundry', 150.00, 'Big Lagoon, El Nido, Palawan.jpg'),
    ('Garden Cottage', 'Single', 'A peaceful stay surrounded by lush gardens.', 'WiFi, AC, Patio', 'Breakfast, Cleaning', 100.00, 'Hidden Beach, El Nido - El Nido\'s Secret Paradise_ Hidden Beach.jpg'),
    ('Luxury Suite', 'Double', 'Spacious suites offering elegant interiors.', 'WiFi, AC, Mini-bar', 'Spa, Concierge', 200.00, 'El Nido Tour A in Palawan_ Big Lagoon & Shimizu Island.jpg')
");

echo "Database elnidosai.db created successfully with tables and sample data.\n";
?>
