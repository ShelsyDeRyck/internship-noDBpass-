<?php

// Database connection
$db = new PDO("mysql:host=localhost;dbname=educational_center", "root", "root");

// Process delete request
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $course_id = $_GET['delete'];

  // Query to delete the course
  $query = $db->prepare("DELETE FROM courses WHERE course_id = :course_id");
  $query->bindParam(':course_id', $course_id);
  $query->execute();

  // Confirmation message
  echo "<p>Cursus succesvol verwijderd!</p>";
}

// Process form data
if (isset($_POST['submit'])) {
  // Get form data
  $name = $_POST['name'];
  $description = $_POST['description'];

  // Query to add a course
  $query = $db->prepare("INSERT INTO courses (name, description) VALUES (:name, :description)");

  // Bind query parameters
  $query->bindParam(':name', $name);
  $query->bindParam(':description', $description);

  // Execute query
  $query->execute();

  // Confirmation message
  echo "<p>Cursus succesvol toegevoegd!</p>";
}

// Get all courses for displaying the list
$courses = $db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nieuwe cursus toevoegen</title>
  <link rel="stylesheet" href="styles/course.css">
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
  </form>

  <h2>Bestaande cursussen</h2>
  <?php if (!empty($courses)): ?>
    <ul class="course-list">
      <?php foreach ($courses as $course): ?>
        <li class="course-item">
          <div class="course-info">
            <h3><?php echo $course['name']; ?></h3>
            <p><?php echo $course['description']; ?></p>
          </div>
          <div class="course-actions">
            <a href="course.php?delete=<?php echo $course['course_id']; ?>" class="btn btn-danger">Verwijderen</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Er zijn nog geen cursussen toegevoegd.</p>
  <?php endif; ?>

  <a href="admin_dashboard.php">Terug naar admin paneel</a>
</body>
</html>