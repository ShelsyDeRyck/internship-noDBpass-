<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if database connection is successful
if ($conn) {
    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set
        if (isset($_POST["id"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["date_of_birth"]) && isset($_POST["study_year"]) && isset($_POST["course_id"])) {
            // Get POST data
            $student_id = $_POST["id"];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $date_of_birth = $_POST["date_of_birth"];
            $study_year = $_POST["study_year"];
            $course_id = $_POST["course_id"];

            // Prepare UPDATE statement
            $sql = "UPDATE students SET first_name=?, last_name=?, email=?, date_of_birth=?, study_year=?, course_id=? WHERE id=?";

            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssiii", $first_name, $last_name, $email, $date_of_birth, $study_year, $course_id, $student_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Student successfully updated.";
            } else {
                echo "Error updating student: " . $conn->error;
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
