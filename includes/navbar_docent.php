<?php include('bootstrap.php'); ?>



<style>
    .navbar-nav {
        align-items: center;
    }

    .hr-nav {
        color: #EA302D;
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav firstnav">
            <a class="navbar-brand" href="../dashboard_docent.php">
                <img src="../assets/logo.png" alt="logo" width="100" height="50">
            </a>
            <li class="nav-item"><a class="nav-link" href="../dashboard_docent.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="../students/student.php">Cursisten</a></li>
            <li class="nav-item"><a class="nav-link" href="../courses/course.php">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="../internships/internship_page.php">Stageplaatsen</a></li>

        </ul>
        <ul class="navbar-nav ms-auto secondnav">
            <li class="nav-item">
                <a class="nav-link" href="../account/accountindex.php">Account</a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-sm btn-outline-danger"><a class="nav-link btnLogout" href="../logout.php">Logout</a></button>
            </li>
        </ul>
    </div>

</nav>
<hr class="hr-nav">