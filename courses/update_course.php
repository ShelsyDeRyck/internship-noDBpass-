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
if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['duration']) && isset($_POST['location'])) {
    // Receive POST data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $location = $_POST['location'];

    // Prepare SQL query to update the course
    $sql = "UPDATE courses SET name=?, description=?, duration=?, location=? WHERE id=?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssssi", $name, $description, $duration, $location, $id);
        if($stmt->execute()) {
            echo "Course updated successfully.";
        } else {
            echo "Error updating course.";
        }
    } else {
        echo "Error preparing statement.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Not all required fields are received.";
}
?>
