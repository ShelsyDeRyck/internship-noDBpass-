<?php
// Include database connection file
include_once "../db_connect.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['description'])) {
        // Receive the data from the request
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $description = $_POST['description'];

        // Establish database connection using MySQLi
        $conn = connectDB();

        // SQL query to update the skill
        $sql = "UPDATE skills SET name = ?, type = ?, description = ? WHERE id = ?";

        // Prepare the SQL query for execution
        $stmt = $conn->prepare($sql);

        // Bind parameters to the SQL query
        $stmt->bind_param("sssi", $name, $type, $description, $id);

        // Execute the SQL query
        if ($stmt->execute()) {
            echo "Skill successfully updated";
        } else {
            echo "Error updating skill: " . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    } else {
        echo "Not all required fields are filled";
    }
} else {
    echo "This file can only be accessed via an HTTP POST request";
}
?>
