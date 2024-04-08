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
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password']; // Add password field

// Prepare SQL statement
$sql = "INSERT INTO teachers (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $first_name, $last_name, $email, $password); // Adjust bind_param to include password

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "Teacher successfully added";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>