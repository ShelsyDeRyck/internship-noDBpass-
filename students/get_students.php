<?php
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
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