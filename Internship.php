<?php
require_once 'db_config.php';

class Internship {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
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
                // If information about a specific internship is needed
                $sql = "SELECT i.*, c.name AS company_name, CONCAT(cp.first_name, ' ', cp.last_name) AS contact_name, cp.phone AS contact_phone, cp.email AS contact_email, CONCAT(s.first_name, ' ', s.last_name) AS student_name
                        FROM internships i
                        INNER JOIN companies c ON i.company_id = c.id
                        INNER JOIN contact_person cp ON i.contact_person_id = cp.id
                        INNER JOIN students s ON i.student_id = s.id
                        WHERE i.id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$internship_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                // If a list of all internships is needed
                $sql = "SELECT i.*, c.name AS company_name, CONCAT(cp.first_name, ' ', cp.last_name) AS contact_name, cp.phone AS contact_phone, cp.email AS contact_email, CONCAT(s.first_name, ' ', s.last_name) AS student_name
                        FROM internships i
                        INNER JOIN companies c ON i.company_id = c.id
                        INNER JOIN contact_person cp ON i.contact_person_id = cp.id
                        INNER JOIN students s ON i.student_id = s.id";
                return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // Error handling should be implemented here
            return false;
        }
    }
    
    

    // Updating information about an internship
public function update($internshipData) {
    try {
        // Begin transaction
        $this->db->beginTransaction();

        // Update companies table
        $sql = "UPDATE companies SET name = ?, address = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$internshipData['company_name'], $internshipData['company_address'], $internshipData['company_id']]);

        // Update contact_person table
        $sql = "UPDATE contact_person SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$internshipData['contact_first_name'], $internshipData['contact_last_name'], $internshipData['contact_email'], $internshipData['contact_phone'], $internshipData['contact_person_id']]);

        // Update internships table
        $sql = "UPDATE internships SET student_id = ?, start_date = ?, end_date = ? WHERE id = ?";
        $stmt = $this->db->prepare("UPDATE internships SET student_id = ? WHERE id = ?");
        $stmt->execute([$internshipData['student_id'], $internshipData['internship_id']]);


        // Commit transaction
        $this->db->commit();
        return true;
    } catch (PDOException $e) {
        // Rollback transaction on error
        $this->db->rollBack();
        // Error handling should be implemented here
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

$internship = new Internship($pdo);
