<?php include ('bootstrap.php'); ?>
<?php

// Get the current page filename (without extension)
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Define the navigation links and their corresponding pages
$navLinks = array(
  "Home" => "dashboard_admin",
  "Courses" => "course",
  "Cursisten" => "student",
  "Docenten" => "docent",
  "Skills" => "skill"
);

?>

<style>
    .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background-color: #eee;
}

.nav-item {
  list-style: none;
  margin: 0 1rem;
}

.nav-link {
  text-decoration: none;
  color: #333;
}

.nav-link.active {
  font-weight: bold;
}
</style>

<nav class="navbar">
  <ul>
  <?php foreach ($navLinks as $label => $page) : ?>
    <li class="nav-item">
      <a href="<?php echo $page; ?>.php" class="nav-link <?php echo ($currentPage == $page) ? 'active' : ''; ?>">
        <?php echo $label; ?>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
</nav>