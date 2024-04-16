
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>    
    <?php include ('bootstrap.php'); ?>
    <link rel="stylesheet" href="./styles/admin.css">

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>

<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav firstnav">
            <a class="navbar-brand" href="../dashboard_admin.php">
                <img src="assets/logo.png" alt="logo" width="100" height="50">
            </a>
        </ul>
        <ul class="navbar-nav ms-auto secondnav">
            <li class="nav-item">
                <a class="nav-link" href="account/accountindex.php">Account</a>
            </li>
            <li class="nav-item">
                    <button><a class="nav-link" href="logout.php">Logout</a></button>
            </li>
        </ul>
    </div>
    </nav>

    <hr class="hr-nav">