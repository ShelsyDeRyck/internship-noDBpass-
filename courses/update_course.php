<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if database connection is successful
if ($conn) {
    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set
        if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["duration"]) && isset($_POST["location"])) {
            // Get POST data
            $course_id = $_POST["id"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $duration = $_POST["duration"];
            $location = $_POST["location"];

            // Prepare UPDATE statement
            $sql = "UPDATE courses SET name=?, description=?, duration=?, location=? WHERE course_id=?";

            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $description, $duration, $location, $course_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Course successfully updated.";
            } else {
                echo "Error updating course: " . $conn->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Required fields are missing.";
        }
    } else {
        echo "Invalid request method.";
    }
} else {
    echo "Database connection failed.";
}

// Close connection
$conn->close();
?>