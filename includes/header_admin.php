
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/admin.css">
    <?php include ('bootstrap.php'); ?>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>
<body>
    <div class="container-fluid">
        <img src="assets/logo.png" alt="logo" class="logo">
        <nav>
            <div class="nav nav-underline">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="account/accountindex.php">My Account</a>
                </li>
                <li class="nav-item">
                    <button><a class="nav-link" href="logout.php">Logout</a></button>
                </li>
                </ul>
            </div>
        </nav>
    </div>
    <hr>
    <div class="container">