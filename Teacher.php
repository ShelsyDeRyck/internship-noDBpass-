<?php

class Docent {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Adding a new lecturer
    public function create($firstName, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
        $sql = "INSERT INTO docenten (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$firstName, $lastName, $email, $hashedPassword])) {
            throw new Exception("Error adding lecturer.");
        }
    }

    // Getting information about the lecturer(s)
    public function read($docent_id = null) {
        if ($docent_id) {
            $sql = "SELECT docent_id, first_name, last_name, email FROM docenten WHERE docent_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$docent_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT docent_id, first_name, last_name, email FROM docenten";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Updating lecturer information
    public function update($docent_id, $firstName, $lastName, $email, $password = null) {
        $sql = "UPDATE docenten SET first_name = ?, last_name = ?, email = ?" . ($password ? ", password = ?" : "") . " WHERE docent_id = ?";
        $params = [$firstName, $lastName, $email];
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params[] = $hashedPassword;
        }
        $params[] = $docent_id;
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute($params)) {
            throw new Exception("Error updating lecturer information.");
        }
    }

    // Deleting a lecturer
    public function delete($docent_id) {
        $sql = "DELETE FROM docenten WHERE docent_id = ?";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$docent_id])) {
            throw new Exception("Error deleting lecturer.");
        }
    }
}
?>
