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

// Ontvang de gegevens van het formulier
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$date_of_birth = $_POST['date_of_birth'];
$study_year = $_POST['study_year'];

// SQL-query voor het toevoegen van een student
$sql = "INSERT INTO students (first_name, last_name, email, date_of_birth, study_year) VALUES ('$first_name', '$last_name', '$email', '$date_of_birth', '$study_year')";

if ($conn->query($sql) === TRUE) {
    echo "Student successfully added";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Sluit de verbinding met de database
$conn->close();
?>