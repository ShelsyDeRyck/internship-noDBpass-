<?php
// Include database connection file
include_once "../db_connect.php";

// Check if the request is made via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID parameter is provided
    if (isset($_POST["id"])) {
        // Establish database connection using MySQLi
        $conn = connectDB();

        // Prepare SQL statement to update the status of the skill to inactive
        $sql = "UPDATE skills SET status = 'inactive' WHERE id = ?";

        // Prepare and bind parameters
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);

            // Set parameters and execute statement
            $id = $_POST["id"];
            if ($stmt->execute()) {
                // Skill soft deleted successfully
                echo "Skill soft deleted successfully.";
            } else {
                // Error occurred while soft deleting skill
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close statement
            $stmt->close();
        }

        // Close connection
        $conn->close();
    } else {
        // ID parameter not provided
        echo "Error: Skill ID not provided.";
    }
} else {
    // Request method is not POST
    echo "Error: Invalid request method.";
}
?>
