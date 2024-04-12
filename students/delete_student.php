<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Controleer of de student-ID is ontvangen via POST
if(isset($_POST['id'])) {
    // Ontvang de student-ID
    $id = $_POST['id'];

    // SQL-query voor het verwijderen van een student
    $sql = "DELETE FROM students WHERE id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute statement
    if ($stmt->execute() === TRUE) {
        echo "Student successfully deleted";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    // Geen student-ID ontvangen, geef een foutmelding terug
    echo "Geen student-ID ontvangen";
}

// Close the database connection
$conn->close();
?>
