<?php
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query om cursusgegevens op te halen
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

// Array initialiseren voor de cursusgegevens
$courses = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Databaseverbinding sluiten
$conn->close();

// Cursusgegevens teruggeven in JSON-indeling
echo json_encode($courses);
?>
