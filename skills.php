<?php

// Database connectie
$db = new PDO("mysql:host=localhost;dbname=educational_center", "root", "root");

// Verwijderen skill
if (isset($_GET['delete'])) {
  $skill_id = $_GET['delete'];

  // Query om skill te verwijderen
  $query = $db->prepare("DELETE FROM skills WHERE skill_id = :skill_id");
  $query->bindParam(':skill_id', $skill_id);
  $query->execute();

  // Terug naar skills pagina
  header('Location: skills.php');
  exit;
}

// Nieuwe skill toevoegen
if (isset($_POST['submit_add'])) {
  $name = $_POST['name'];
  $type = $_POST['type'];
  $description = $_POST['description'];

  // Query om nieuwe skill toe te voegen
  $query = $db->prepare("INSERT INTO skills (name, type, description) VALUES (:name, :type, :description)");
  $query->bindParam(':name', $name);
  $query->bindParam(':type', $type);
  $query->bindParam(':description', $description);
  $query->execute();

  // Terug naar skills pagina
  header('Location: skills.php');
  exit;
}

// Bewerk skill
if (isset($_GET['edit'])) {
  $skill_id = $_GET['edit'];

  // Query om skill te laden
  $query = $db->prepare("SELECT * FROM skills WHERE skill_id = :skill_id");
  $query->bindParam(':skill_id', $skill_id);
  $query->execute();
  $skill = $query->fetch(PDO::FETCH_ASSOC);

  // Formulier tonen met pre-ingevulde waarden
  if (isset($_POST['submit_edit'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    // Query om skill te bewerken
    $query = $db->prepare("UPDATE skills SET name = :name, type = :type, description = :description WHERE skill_id = :skill_id");
    $query->bindParam(':name', $name);
    $query->bindParam(':type', $type);
    $query->bindParam(':description', $description);
    $query->bindParam(':skill_id', $skill_id);
    $query->execute();

    // Terug naar skills pagina
    header('Location: skills.php');
    exit;
  }
}

// Zoeken naar skills
if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];

  // Query om skills te filteren op naam
  $query = $db->prepare("SELECT * FROM skills WHERE name LIKE :searchTerm");
  $query->bindValue(':searchTerm', "%$searchTerm%");
  $query->execute();
  $skills = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
  // Query om alle skills te laden
  $query = $db->query("SELECT * FROM skills");
  $skills = $query->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['delete_selected'])) {
  // Ophalen van geselecteerde course ID's
  $selected_courses = $_POST['courses'];

  // Aantal verwijderde courses
  $deletedCount = 0;

  // Loop door de geselecteerde IDs
  foreach ($selected_courses as $course_id) {
    // Query om course te verwijderen
    $query = $db->prepare("DELETE FROM skills WHERE skill_id = :course_id");
    $query->bindValue(':course_id', $course_id, PDO::PARAM_INT);

    // Uitvoeren van de query
    $query->execute();

    // Verhogen van de teller
    $deletedCount++;
  }

  // Bericht tonen
  echo "<p><strong>$deletedCount courses succesvol verwijderd.</strong></p>";

  // Terug naar skills pagina
  header('Location: skills.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skills beheren</title>
  <link rel="stylesheet" href="styles/skills.css">
</head>
<body>

<h1>Skills beheren</h1>

<div class="container">
  <div class="search-bar">
    <form method="get">
      <input type="text" name="search" id="search-input" placeholder="Zoek naar skills">
      <button type="submit" id="search-button">Zoeken</button>
    </form>
  </div>

  <div class="skills-list">
    <form method="post">
      <table>
        <thead>
          <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>Naam</th>
            <th>Type</th>
            <th>Beschrijving</th>
            <th>Acties</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($skills as $skill) { ?>
            <tr>
              <td><input type="checkbox" name="courses[]" value="<?php echo $skill['skill_id']; ?>"></td>
              <td><?php echo $skill['name']; ?></td>
              <td class="skill-type <?php echo $skill['type']; ?>"><?php echo $skill['type']; ?></td>
              <td><?php echo $skill['description']; ?></td>
              <td>
                <a href="skills.php?edit=<?php echo $skill['skill_id']; ?>" class="btn btn-primary">Bewerken</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <br>
      <input type="submit" name="delete_selected" value="Geselecteerde courses verwijderen">
    </form>
  </div>

  <div class="add-skill">
    <h2>Nieuwe skill toevoegen</h2>
    <form method="post">
      <label for="name">Naam:</label>
      <input type="text" name="name" id="name">
      <br>
      <label for="type">Type:</label>
      <select name="type" id="type">
        <option value="soft">Soft</option>
        <option value="hard">Hard</option>
      </select>
      <br>
      <label for="description">Beschrijving:</label>
      <br>
      <textarea name="description" id="description" rows="5" cols="50"></textarea>
      <br>
      <br>
      <input type="submit" name="submit_add" value="Toevoegen">
    </form>
  </div>

  <?php if (isset($_GET['edit'])) { ?>
    <div class="edit-skill">
      <h2>Skill bewerken</h2>
      <form method="post">
        <label for="name">Naam:</label>
        <input type="text" name="name" id="name" value="<?php echo $skill['name']; ?>">
        <br>
        <label for="type">Type:</label>
        <select name="type" id="type">
          <option value="soft" <?php if ($skill['type'] === 'soft') echo 'selected'; ?>>Soft</option>
          <option value="hard" <?php if ($skill['type'] === 'hard') echo 'selected'; ?>>Hard</option>
        </select>
        <br>
        <label for="description">Beschrijving:</label>
        <br>
        <textarea name="description" id="description" rows="5" cols="50"><?php echo $skill['description']; ?></textarea>
        <br>
        <br>
        <input type="submit" name="submit_edit" value="Opslaan">
      </form>
    </div>
  <?php } ?>
</div>

</body>
</html>