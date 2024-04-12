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

// Check if there are any results
if ($result->num_rows > 0) {
    // Initialize an empty array to store inactive skills
    $inactiveSkills = array();

    // Fetch each row and add it to the inactiveSkills array
    while ($row = $result->fetch_assoc()) {
        $inactiveSkills[] = $row;
    }

    // Encode the array as JSON and echo it
    echo json_encode($inactiveSkills);
} else {
    echo "No inactive skills found";
}

// Close the connection
$conn->close();
?>
