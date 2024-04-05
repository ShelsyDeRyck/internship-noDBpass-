<?php
require_once 'db_config.php';

class Internship {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Adding a new internship
    public function create($company_id, $address, $contact_person_id, $start_date, $end_date, $student_id) {
        try {
            $sql = "INSERT INTO internships (company_id, address, contact_person_id, start_date, end_date, student_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$company_id, $address, $contact_person_id, $start_date, $end_date, $student_id]);
            return true;
        } catch (PDOException $e) {
            // Ideally, log the error
            return false;
        }
    }

    // Getting information about internships
    public function read($internship_id = null) {
        try {
            if ($internship_id) {
                $sql = "SELECT * FROM internships WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$internship_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM internships";
                return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // Ideally, log the error
            return false;
        }
    }

    // Updating internship information
    public function update($internship_id, $company_id, $address, $contact_person_id, $start_date, $end_date, $student_id) {
        try {
            $sql = "UPDATE internships SET company_id = ?, address = ?, contact_person_id = ?, start_date = ?, end_date = ?, student_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$company_id, $address, $contact_person_id, $start_date, $end_date, $student_id, $internship_id]);
            return true;
        } catch (PDOException $e) {
            // Ideally, log the error
            return false;
        }
    }

    // Deleting internship
    public function delete($internship_id) {
        try {
            $sql = "DELETE FROM internships WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$internship_id]);
            return true;
        } catch (PDOException $e) {
            // Ideally, log the error
            return false;
        }
    }
}

$internship = new Internship($db);
