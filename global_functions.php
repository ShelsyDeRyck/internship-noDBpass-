<?php

function fetchUserByType($pdo, $email, $type)
{
  $stmt = $pdo->prepare("SELECT * FROM $type WHERE email = ?");
  $stmt->execute([$email]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
