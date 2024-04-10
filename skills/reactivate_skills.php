<?php
// Include your database connection file if needed
include '../db_connect.php';

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if skills data is received
    if (isset($_POST['skills'])) {
        // Convert the received data into an array
        $selectedSkills = $_POST['skills'];

        // Prepare a placeholder for the SQL query
        $placeholders = implode(',', array_fill(0, count($selectedSkills), '?'));

        // Prepare the SQL query to update the status of selected skills to active
        $sql = "UPDATE skills SET status = 'active' WHERE id IN ($placeholders)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $types = str_repeat('i', count($selectedSkills)); // Assuming skill IDs are integers
        $stmt->bind_param($types, ...$selectedSkills);

        // Execute the statement
        if ($stmt->execute()) {
            // Skills reactivated successfully
            $response = array(
                'status' => 'success',
                'message' => 'Selected skills reactivated successfully.'
            );
        } else {
            // Error occurred while reactivating skills
            $response = array(
                'status' => 'error',
                'message' => 'Error occurred while reactivating skills: ' . $conn->error
            );
        }

        // Close the statement
        $stmt->close();
    } else {
        // No skills selected for reactivation
        $response = array(
            'status' => 'error',
            'message' => 'No skills selected for reactivation.'
        );
    }
} else {
    // Invalid request method
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method.'
    );
}

// Convert response to JSON and output
echo json_encode($response);

// Close the database connection if needed
$conn->close();
?>
