<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query om docentengegevens op te halen
$sql = "SELECT * FROM teachers";
$result = $conn->query($sql);

// Array initialiseren voor de docentengegevens
$teachers = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teachers[] = $row;
    }
}

// Databaseverbinding sluiten
$conn->close();

// Docentengegevens teruggeven in JSON-indeling
echo json_encode($teachers);
?>
