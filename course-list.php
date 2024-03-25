<?php

require_once 'db-connect.php';

// Databaseverbinding
$db = new PDO("mysql:host=localhost;dbname=educational_center", "root", "root");

// Query uitvoeren
$query = $db->prepare("SELECT * FROM courses");
$query->execute();

// Resultaten ophalen
$courses = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="nl">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage2024</title>
    <link rel="stylesheet" href="styles/course-list.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursussenlijst</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Cursussen</h1>
  </header>
  <main>
    <section class="courses">
      <?php foreach ($courses as $course): ?>
        <article class="course">
          <h2><?php echo $course['name']; ?></h2>
          <p><?php echo $course['description']; ?></p>
        </article>
      <?php endforeach; ?>
    </section>
  </main>
  <a href="admin_dashboard.php">Terug naar admin paneel</a>
  <footer>
    &copy; 2023 - Educational Database
  </footer>
</body>
</html>