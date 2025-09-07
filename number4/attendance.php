<?php
require_once "database.php";

class AttendanceManager extends Database
{
    // Add attendance record
    public function addAttendance($studentId, $attDate, $attStatus)
    {
        $query = "INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)";
        $this->runQuery($query, [$studentId, $attDate, $attStatus]);
        return "New attendance has been added.";
    }

    // Fetch all attendance records
    public function getAllAttendance()
    {
        $query = "SELECT a.id, s.name AS student_name, s.email AS student_email, a.date, a.status
                  FROM attendance a
                  INNER JOIN students s ON s.id = a.student_id";
        return $this->runQuery($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch one attendance record by ID
    public function getAttendanceById($attendanceId)
    {
        $query = "SELECT * FROM attendance WHERE id = ?";
        return $this->runQuery($query, [$attendanceId])->fetch(PDO::FETCH_ASSOC);
    }

    // Edit attendance status
    public function editAttendance($attendanceId, $newStatus)
    {
        $query = "UPDATE attendance SET status = ? WHERE id = ?";
        $this->runQuery($query, [$newStatus, $attendanceId]);
        return "Attendance status changed successfully.";
    }

    // Remove attendance record
    public function removeAttendance($attendanceId)
    {
        $query = "DELETE FROM attendance WHERE id = ?";
        $this->runQuery($query, [$attendanceId]);
        return "Attendance record removed.";
    }
}
?>
