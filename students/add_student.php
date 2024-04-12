<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ontvang de gegevens van het formulier
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$date_of_birth = $_POST['date_of_birth'];
$study_year = $_POST['study_year'];

// Prepare SQL statement
$sql = "INSERT INTO students (first_name, last_name, email, date_of_birth, study_year) VALUES (?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $first_name, $last_name, $email, $date_of_birth, $study_year);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "Student successfully added";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
