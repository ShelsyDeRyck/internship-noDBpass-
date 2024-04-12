<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch course data
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

// Array initialization for course data
$courses = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Close database connection
$conn->close();

// Return course data in JSON format
echo json_encode($courses);
?>
