<?php
require_once "database.php";

class StudentManager extends DbConnection
{
    private $tableName = "student_list";

    // Add new student
    public function addStudent($fullName, $emailAddr)
    {
        $query = "INSERT INTO {$this->tableName} (full_name, email_address) VALUES (?, ?)";
        $this->execute($query, [$fullName, $emailAddr]);
        return "New student record inserted.";
    }

    // Get all students
    public function getAllStudents()
    {
        $query = "SELECT * FROM {$this->tableName}";
        return $this->execute($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single student by ID
    public function getStudent($studentId)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE student_id = ?";
        return $this->execute($query, [$studentId])->fetch(PDO::FETCH_ASSOC);
    }

    // Update student info
    public function updateStudent($studentId, $newName, $newEmail)
    {
        $query = "UPDATE {$this->tableName} SET full_name = ?, email_address = ? WHERE student_id = ?";
        $this->execute($query, [$newName, $newEmail, $studentId]);
        return "Student record updated.";
    }

    // Remove student
    public function deleteStudent($studentId)
    {
        $query = "DELETE FROM {$this->tableName} WHERE student_id = ?";
        $this->execute($query, [$studentId]);
        return "Student record deleted.";
    }
}
?>
