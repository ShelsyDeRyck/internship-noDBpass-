<?php
// Include the database connection file
include_once '../db_connect.php';

// Establish database connection using MySQLi
$conn = connectDB();

// Check if the form data is received
if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['description'])) {
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

    // Close prepared statement
    $stmt->close();
} else {
    // Invalid input received
    echo "Invalid input received";
}

// Close database connection
$conn->close();
?>
