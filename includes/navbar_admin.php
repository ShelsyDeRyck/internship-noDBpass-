<?php include('bootstrap.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



<style>
  .navbar-nav {
    align-items: center;
  }

  nav {
    border-bottom: #EA302D solid 5px;
  }

  .btnLogout {
    color: #EA302D;
  }

  .btnLogout:hover {
    color: white;
  }

  .nav-item:hover {
    font-weight: bold;
  }
</style>

<nav class="navbar navbar-expand-lg mb-3">
  <div class="container-fluid">
    <ul class="navbar-nav firstnav">
      <a class="navbar-brand" href="../dashboard_admin.php">
        <img src="../assets/logo.png" alt="logo" width="100" height="50">
      </a>
      <li class="nav-item"><a class="nav-link" href="../dashboard_admin.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="../students/student.php">Cursisten</a></li>
      <li class="nav-item"><a class="nav-link" href="../courses/course.php">Courses</a></li>
      <li class="nav-item"><a class="nav-link" href="../teachers/teacher.php">Docenten</a></li>
      <li class="nav-item"><a class="nav-link" href="../skills/skills.php">Skills</a></li>
      <li class="nav-item"><a class="nav-link" href="../internships/internship_page.php">Stageplaatsen</a></li>

    </ul>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end id=" navbarNav">
      <ul class="navbar-nav ms-auto secondnav">
        <li class="nav-item">
          <a class="nav-link" href="../account/accountindex.php">Account</a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn-sm btn-outline-danger"><a class="nav-link btnLogout" href="../logout.php">Logout</a></button>
        </li>
      </ul>
    </div>
  </div>

</nav>