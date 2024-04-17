<?php
// Include database connection file
include_once "../db_connect.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Receive POST data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if any required field is empty
        if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
            echo "All fields are required";
            exit; // Stop further execution
        }

        // Establish database connection using MySQLi
        $conn = connectDB();

        // Prepare SQL statement
        $sql = "INSERT INTO teachers (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
            echo "Teacher successfully added";
        } else {
            echo "Error adding teacher: " . $conn->error;
        }

        // Close prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Not all required fields are filled";
    }
} else {
    echo "This file can only be accessed via an HTTP POST request";
}
?>

