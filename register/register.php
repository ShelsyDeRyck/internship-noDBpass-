<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])) {
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $userType = $_POST['user_type']; // The selected user type from the form
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];

  try {
    $pdo = connectPDO();
    // Insert into the specific table based on user type selected
    if (in_array($userType, ['teachers', 'admins'])) {
      $stmt = $pdo->prepare("INSERT INTO $userType (email, password, first_name, last_name) VALUES (?, ?, ?, ?)");
      $stmt->execute([$email, $password, $firstname, $lastname]);
      echo 'User registered successfully!';
    } else {
      echo 'Invalid user type selected!';
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>

<form method="post">
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  firstname: <input type="text" name="firstname" required><br>
  lastname: <input type="text" name="lastname" required><br>
  User Type:
  <select name="user_type" required>
    <option value="">Select User Type</option>
    <option value="teachers">Teacher</option>
    <option value="admins">Admin</option>
  </select><br>
  <button type="submit">Register</button>
</form>