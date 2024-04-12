<?php

// Assuming $hashedPassword is the hash retrieved from the database.
$hashedPassword = '$2y$10$XwSY8FLL7vCTT4NddNhFR.cdCDcYWqEjjV/GBYUMG9/6OohEBa2QO';

// The original password you want to check.
$originalPassword = 'securepassword1';

// Password verification.
if (password_verify($originalPassword, $hashedPassword)) {
    echo 'Password is correct!';
} else {
    echo 'Incorrect password.';
}

?>
