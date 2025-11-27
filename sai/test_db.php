<?php
// test_db.php - Test database connection and basic queries

$db = new SQLite3('sai.db');

if (!$db) {
    die("Database connection failed.\n");
}

echo "Database connection successful.\n";

// Test users table
$result = $db->query("SELECT COUNT(*) as count FROM users");
$row = $result->fetchArray(SQLITE3_ASSOC);
echo "Users count: " . $row['count'] . "\n";

// Test rooms table
$result = $db->query("SELECT COUNT(*) as count FROM rooms");
$row = $result->fetchArray(SQLITE3_ASSOC);
echo "Rooms count: " . $row['count'] . "\n";

// Test bookings table
$result = $db->query("SELECT COUNT(*) as count FROM bookings");
$row = $result->fetchArray(SQLITE3_ASSOC);
echo "Bookings count: " . $row['count'] . "\n";

echo "Database test completed.\n";
?>
