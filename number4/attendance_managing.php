<?php
require_once "attendance.php";
require_once "student.php";

$attendanceManager = new AttendanceManager();
$studentManager = new StudentManager();
$feedback = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studId = $_POST['student_id'];
    $attDate = $_POST['date'];
    $attStatus = $_POST['status'];

    if (!empty($_POST['attendance_id'])) {
        // Update existing record
        $attendanceManager->editAttendance($_POST['attendance_id'], $attStatus);
        $feedback = "Attendance record updated.";
    } else {
        // Add new record
        $attendanceManager->addAttendance($studId, $attDate, $attStatus);
        $feedback = "New attendance added.";
    }

    header("Location: attendance_manager.php");
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $attendanceManager->removeAttendance($_GET['delete']);
    $feedback = "Attendance record deleted.";
    header("Location: attendance_manager.php");
    exit;
}

// Handle edit request
$currentRecord = null;
if (isset($_GET['edit'])) {
    $currentRecord = $attendanceManager->getAttendanceById($_GET['edit']);
}

// Fetch all students and attendance list
$studentList = $studentManager->getAllStudents();
$attendanceList = $attendanceManager->getAllAttendance();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance System</title>
</head>
<body>
    <h1>Attendance System</h1>

    <?php if ($feedback): ?>
        <p style="color:green;"><b><?php echo $feedback; ?></b></p>
    <?php endif; ?>

    <!-- Attendance Form -->
    <h2><?php echo $currentRecord ? "Update Attendance" : "Add Attendance"; ?></h2>
    <form method="post">
        <input type="hidden" name="attendance_id" value="<?php echo $currentRecord['id'] ?? ''; ?>">

        <label for="student">Student:</label>
        <select name="student_id" required>
            <option value="">-- Select Student --</option>
            <?php foreach ($studentList as $stud): ?>
                <option value="<?php echo $stud['student_id']; ?>"
                    <?php echo ($currentRecord && $currentRecord['student_id'] == $stud['student_id']) ? 'selected' : ''; ?>>
                    <?php echo $stud['full_name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $currentRecord['attendance_date'] ?? ''; ?>" required>
        <br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Present" <?php echo ($currentRecord && $currentRecord['attendance_status'] == "Present") ? "selected" : ""; ?>>Present</option>
            <option value="Absent" <?php echo ($currentRecord && $currentRecord['attendance_status'] == "Absent") ? "selected" : "";_]()
