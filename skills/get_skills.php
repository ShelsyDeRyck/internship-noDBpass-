<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch skill data
$sql = "SELECT * FROM skills";
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