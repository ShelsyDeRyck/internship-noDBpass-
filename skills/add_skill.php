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
$type = $_POST['type']; // Assuming 'type' is received from the form
$description = $_POST['description'];

// Prepare SQL statement
$sql = "INSERT INTO skills (name, type, description) VALUES (?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $type, $description);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "Skill successfully added";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>