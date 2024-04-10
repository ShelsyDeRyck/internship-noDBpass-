<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive form data
$name = $_POST['name'];
$description = $_POST['description'];
$duration = $_POST['duration'];
$location = $_POST['location'];

// Prepare SQL statement
$sql = "INSERT INTO courses (name, description, duration, location) VALUES (?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $description, $duration, $location);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "Course successfully added";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>