<?php
require_once 'db_config.php';

class Skills {
    // Adding a new skill with type validation
    public function create($name, $type) {
        global $pdo;
        // Checking for valid skill type values
        if ($type !== 'softskill' && $type !== 'hardskill') {
            return false; // Invalid skill type
        }

        $sql = "INSERT INTO skills (name, type) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$name, $type]);
        return $success;
    }

    // Getting the list of skills, optionally filtered by type
    public function read($type = null) {
        global $pdo;
        if ($type !== null && ($type === 'softskill' || $type === 'hardskill')) {
            $sql = "SELECT * FROM skills WHERE type = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$type]);
        } else {
            $sql = "SELECT * FROM skills";
            $stmt = $pdo->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Updating a skill
    public function update($skill_id, $name, $type) {
        global $pdo;
        // Checking for valid skill type values
        if ($type !== 'softskill' && $type !== 'hardskill') {
            return false; // Invalid skill type
        }

        $sql = "UPDATE skills SET name = ?, type = ? WHERE skill_id = ?";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$name, $type, $skill_id]);
        return $success;
    }

    // Deleting a skill
    public function delete($skill_id) {
        global $pdo;
        $sql = "DELETE FROM skills WHERE skill_id = ?";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$skill_id]);
        return $success;
    }
}
?>
