<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Check if the teacher ID is received via POST
if(isset($_POST['id'])) {
    // Receive the teacher ID
    $id = $_POST['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete a teacher
    $sql = "DELETE FROM teachers WHERE docent_id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Teacher successfully deleted";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // No teacher ID received, return an error message
    echo "No teacher ID received";
}
?>