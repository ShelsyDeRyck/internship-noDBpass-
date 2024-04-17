<?php
// Include database connection file
include_once "../db_connect.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['duration']) && isset($_POST['location'])) {
        // Receive form data
        $name = $_POST['name'];
        $description = $_POST['description'];
        $duration = $_POST['duration'];
        $location = $_POST['location'];

        // Check if any required field is empty
        if (empty($name) || empty($description) || empty($duration) || empty($location)) {
            echo "All fields are required";
            exit; // Stop further execution
        }

        // Establish database connection using MySQLi
        $conn = connectDB();

        // Prepare SQL statement
        $sql = "INSERT INTO courses (name, description, duration, location) VALUES (?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $description, $duration, $location);

        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
            echo "Course successfully added";
        } else {
            echo "Error adding course: " . $conn->error;
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

