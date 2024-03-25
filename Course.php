<?php

// Databaseverbinding
$db = new PDO("mysql:host=localhost;dbname=educational_center", "root", "root");

// Verwerk formulierdata
if (isset($_POST['submit'])) {
  // Formulierdata ophalen
  $name = $_POST['name'];
  $description = $_POST['description'];

  // Query voor het toevoegen van een cursus
  $query = $db->prepare("INSERT INTO courses (name, description) VALUES (:name, :description)");

  // Query parameters binden
  $query->bindParam(':name', $name);
  $query->bindParam(':description', $description);

  // Query uitvoeren
  $query->execute();

  // Bevestigingsbericht tonen
  echo "<p>Cursus succesvol toegevoegd!</p>";
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage2024</title>
    <link rel="stylesheet" href="styles/course.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nieuwe cursus toevoegen</title>
</head>
<body>
  <h1>Nieuwe cursus toevoegen</h1>
  <form method="post">
    <label for="name">Naam:</label>
    <input type="text" name="name" id="name">
    <br>
    <label for="description">Beschrijving:</label>
    <br>
    <textarea name="description" id="description" rows="5" cols="50"></textarea>
    <br>
    <br>
    <input type="submit" name="submit" value="Toevoegen">
    <a href="admin_dashboard.php">Terug naar admin paneel</a>
  </form>
</body>
</html>