<?php
// Include the database connection file
include_once '../db_connect.php';

// Establish database connection using MySQLi
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch only active skills
$sql = "SELECT * FROM skills WHERE status = 'active'";
$result = $conn->query($sql);

// Array initialization for skill data
$skills = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $skills[] = $row;
    }
}

// Close database connection
$conn->close();

// Return skill data in JSON format
echo json_encode($skills);
?>
