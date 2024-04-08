<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of de vereiste velden zijn ingestuurd
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['description'])) {
        // Ontvang de gegevens van het verzoek
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $description = $_POST['description'];

        // SQL-query om de vaardigheid bij te werken
        $sql = "UPDATE skills SET name = ?, type = ?, description = ? WHERE skill_id = ?";

        // Bereid de SQL-query voor uitvoering
        $stmt = $conn->prepare($sql);

        // Bind de parameters aan de SQL-query
        $stmt->bind_param("sssi", $name, $type, $description, $id);

        // Voer de SQL-query uit
        if ($stmt->execute()) {
            echo "Skill succesvol bijgewerkt";
        } else {
            echo "Er is een fout opgetreden bij het bijwerken van de skill: " . $conn->error;
        }

        // Sluit de SQL-instructie
        $stmt->close();
    } else {
        echo "Niet alle vereiste velden zijn ingevuld";
    }
} else {
    echo "Dit bestand kan alleen worden aangeroepen via een HTTP POST-verzoek";
}
?>
