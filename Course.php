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
  // Check if editing or adding a new course (based on hidden field)
  $is_edit = isset($_POST['course_id']) && is_numeric($_POST['course_id']);

  if ($is_edit) {
    $course_id = $_POST['course_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Query to update the course (if editing)
    $query = $db->prepare("UPDATE courses SET name = :name, description = :description WHERE course_id = :course_id");
    $query->bindParam(':name', $name);
    $query->bindParam(':description', $description);
    $query->bindParam(':course_id', $course_id);
    $query->execute();

    // Confirmation message
    echo "<p>Cursus succesvol gewijzigd!</p>";
  } else {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Query to add a new course (if not editing)
    $query = $db->prepare("INSERT INTO courses (name, description) VALUES (:name, :description)");
    $query->bindParam(':name', $name);
    $query->bindParam(':description', $description);
    $query->execute();

    // Confirmation message
    echo "<p>Cursus succesvol toegevoegd!</p>";
  }
}

// Get all courses for displaying the list
$courses = $db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage2024</title>
    <link rel="stylesheet" href="styles/course.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php
// Check for edit request (display edit form if applicable)
if (isset($_GET['edit'])) {

  // Query to get the latest course data (assuming editing the most recent)
  $query = $db->query("SELECT * FROM courses ORDER BY course_id DESC LIMIT 1");
  $course = $query->fetch(PDO::FETCH_ASSOC);

  if (!$course) {
    echo "<p>Er zijn nog geen cursussen.</p>";
  } else {
?>

  <h2>Cursus bewerken</h2>
  <form method="post">
    <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
    <label for="name">Naam:</label>
    <input type="text" name="name" id="name" value="<?php echo $course['name']; ?>">
    <br>
    <label for="description">Beschrijving:</label>
    <br>
    <textarea name="description" id="description" rows="5" cols="50"><?php echo $course['description']; ?></textarea>
    <br>
    <br>
    <input type="submit" name="submit" value="Opslaan">
  </form>

<?php
  } // end if (!$course)
} else { // Display form for adding a new course
?>

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
    <input type="submit" name="submit" value="Opslaan">
  </form>

<?php
} // end if (isset($_GET['edit']))
?>

<h2>Bestaande cursussen</h2>

<?php
if (count($courses) > 0) {
  echo "<ul class='course-list'>";
  foreach ($courses as $course) {
?>
    <li class="course-item">
      <div class="course-info">
        <h3><?php echo $course['name']; ?></h3>
        <p><?php echo $course['description']; ?></p>
      </div>
      <div class="course-actions">
        <a href="course.php?edit=true" class="btn btn-primary">Bewerken</a>
        <a href="course.php?delete=<?php echo $course['course_id']; ?>" class="btn btn-danger">Verwijderen</a>
      </div>
    </li>
<?php
  }
  echo "</ul>";
} else {
  echo "<p>Er zijn nog geen cursussen toegevoegd.</p>";
}
?>

</body>
</html>