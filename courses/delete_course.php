<?php
// Include database connection file
include_once "../db_connect.php";

// Check if the course ID is received via POST
if(isset($_POST['id'])) {
    // Receive the course ID
    $id = $_POST['id'];

    // Establish database connection using MySQLi
    $conn = connectDB();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete a course
    $sql = "DELETE FROM courses WHERE id = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Course successfully deleted";
    } else {
        echo "Error deleting course: " . $conn->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // No course ID received, return an error message
    echo "No course ID received";
}
?>
