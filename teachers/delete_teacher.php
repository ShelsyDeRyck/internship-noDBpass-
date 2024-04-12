<?php
// Include database connection file
include_once "../db_connect.php";

// Check if the teacher ID is received via POST
if(isset($_POST['id'])) {
    // Receive the teacher ID
    $id = $_POST['id'];

    // Establish database connection using MySQLi
    $conn = connectDB();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete a teacher
    $sql = "DELETE FROM teachers WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Teacher successfully deleted";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error preparing statement.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // No teacher ID received, return an error message
    echo "No teacher ID received";
}
?>
