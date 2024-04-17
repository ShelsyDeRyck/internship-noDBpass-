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

// Initialize an empty array for skill data
$skills = array();

// Check if the query was executed successfully
if ($result) {
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch data
        while ($row = $result->fetch_assoc()) {
            $skills[] = $row;
        }
    } else {
        // No active skills found
        echo "No active skills found.";
    }
} else {
    // Query execution failed
    echo "Error executing query: " . $conn->error;
}

// Close database connection
$conn->close();

// Return skill data in JSON format
echo json_encode($skills);
?>
