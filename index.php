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
$loginError = ''; // Initialize an error message variable
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  try {
    $pdo = connectPDO();
    $tables = ['teachers', 'admins', 'students'];
    list($user, $type) = fetchUser($pdo, $email, $tables);

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $type;

        // Redirect based on user type
        if ($type === 'teachers') {
          header('Location: ./dashboard_docent.php');
        } elseif ($type === 'admins') {
          header('Location: ./dashboard_admin.php');
        }
        exit;
      } else {
        $loginError = 'Verkeerd wachtwoord!';
      }
    } else {
      $loginError = 'Gebruiker niet gevonden!';
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
  <div class="container" id="container">
    <div class="form-container sign-in-container">
      <form method="POST" action="#">
        <h1>Log in</h1>
        <input type="email" placeholder="Email" name="email" class="input-email" required />
        <input type="password" placeholder="Password" name="password" required />
        <button type="submit" class="login-button">Log In</button>
        <?php if ($loginError) : ?>
          <p class="error"><?php echo $loginError; ?></p>
        <?php endif; ?>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <img class="login-logo" src="https://cookie-cdn.cookiepro.com/logos/564c6d45-0689-43be-9dd4-ee251b128a04/4f6aa339-3a53-4c89-8f20-5486b2bfad47/f2341983-ce70-4e2a-96ad-4e89b6a30ccd/SyntraPXL_Logo_Digitaal_Wit.png" alt="">
          <p style="font-weight: bolder;">Welkom bij de stagebegeleidingstool voor de docenten van SyntraPXL.</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#loginForm').submit(function(e) {
        var email = $('#email').val();
        var password = $('#password').val();
        if (email.trim() === '' || password.trim() === '') {
          e.preventDefault();
          showToast('Gelieve een email en wachtwoord in te vullen.');
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
  </div>
  <?php include('includes/footer.php'); ?>
</body>

</html>