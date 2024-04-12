<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-query voor het ophalen van studenten
$sql = "SELECT * FROM students";

$result = $conn->query($sql);

// Array om studentengegevens op te slaan
$students = array();

// Controleren of er resultaten zijn
if ($result->num_rows > 0) {
    // Loop door de resultaten en sla ze op in de array
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Sluit de verbinding met de database
$conn->close();

// Geef de studentengegevens terug als JSON
echo json_encode($students);
?>
