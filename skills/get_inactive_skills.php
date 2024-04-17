<?php
// Include the database connection file
include_once '../db_connect.php';

// Establish database connection using MySQLi
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch inactive skills from the database
$sql = "SELECT * FROM skills WHERE status = 'inactive'";
$result = $conn->query($sql);

$inactiveSkills = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inactiveSkills[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return the JSON representation of the inactive skills
echo json_encode($inactiveSkills);
?>
