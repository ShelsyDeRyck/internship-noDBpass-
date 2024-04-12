<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all required fields are received via POST
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Receive POST data
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

    // Close prepared statement
    $stmt->close();
} else {
    echo "Not all required fields are received.";
}

// Close database connection
$conn->close();
?>
