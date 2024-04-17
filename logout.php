<?php
session_start();

// Leeg alle sessievariabelen
session_unset();

// Vernietig de sessie
session_destroy();

// Redirect naar de indexpagina
header('Location: index.php');
exit;
