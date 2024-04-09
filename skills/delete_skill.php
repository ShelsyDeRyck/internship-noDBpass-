<?php
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Controleren of de skill-ID is ontvangen via POST
if(isset($_POST['id'])) {
    // Ontvang de skill-ID
    $id = $_POST['id'];

    // Databaseverbinding maken
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL-query voor het verwijderen van een skill
    $sql = "DELETE FROM skills WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Skill succesvol verwijderd";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Databaseverbinding sluiten
    $conn->close();
} else {
    // Geen skill-ID ontvangen, geef een foutmelding terug
    echo "Geen skill-ID ontvangen";
}
?>