<?php
session_start();
require_once './db_connect.php';

function fetchUser($pdo, $email, $tables)
{
  foreach ($tables as $table) {
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user) {
      return [$user, $table];
    }
  }
  return [null, null];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  try {
    $pdo = connectPDO();
    $tables = ['teachers', 'admins', 'students'];
    list($user, $type) = fetchUser($pdo, $email, $tables);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_type'] = $type;

      // Debugging output
      echo "Session user_id set to: " . $_SESSION['user_id'];
      echo "Session user_type set to: " . $_SESSION['user_type'];

      // Redirect based on user type
      if ($type === 'teachers') {
        header('Location: ./dashboard_docent.php');
      } elseif ($type === 'admins') {
        header('Location: ./dashboard_admin.php');
      }
      exit;
    } else {
      echo 'Login failed!';
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stage2024</title>
  <link rel="stylesheet" href="styles/index.css">
  <?php include('includes/bootstrap.php'); ?>
</head>

<body>
  <div class="container-fluid">

    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1><img src="assets/logo.png" alt="logo" class="logo"></h1>
          <h2>WELKOM BIJ SYNTRA PXL STAGE MANAGEMENT</h2>
          <p>Gelieve eerst in te loggen.</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form method="post" id="loginForm">
            <div class="form-group">
              <label class="form-label" for="email">Email:</label>
              <input class="form-control" type="text" id="email" name="email">
            </div>
            <div class="form-group">
              <label class="form-label" for="password">Password:</label>
              <input class="form-control" type="password" id="password" name="password">
            </div>
            <button class="btn btn-primary mt-3" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#loginForm').submit(function(e) {
          var email = $('#email').val();
          var password = $('#password').val();

          if (email.trim() === '' || password.trim() === '') {
            e.preventDefault();
            showToast('gelieven een email en wachtwoord in te vullen');
          }
        });

        function showToast(message) {
          $('.toast-body').text(message);
          $('.toast').toast('show');
        }
      });
    </script>


    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
      <div class="toast-header">
        <strong class="mr-auto">Attention</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">

      </div>






      <?php include('includes/footer.php'); ?>