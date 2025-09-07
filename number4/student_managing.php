<?php
require_once "student.php";

$studentObj = new Student();
$feedback = "";

// --- Form Handling: Add or Update Student ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id    = $_POST['id'] ?? null;
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);

    if ($id) {
        // Update existing record
        $studentObj->update($id, $name, $email);
        $feedback = "Student record updated successfully!";
    } else {
        // Insert new record
        $studentObj->create($name, $email);
        $feedback = "New student added successfully!";
    }

    // Redirect to prevent resubmission
    header("Location: student_manager.php?msg=" . urlencode($feedback));
    exit;
}

// --- Delete Student ---
if (isset($_GET['delete'])) {
    $studentObj->delete($_GET['delete']);
    header("Location: student_manager.php?msg=" . urlencode("Student removed successfully!"));
    exit;
}

// --- Load Student for Editing ---
$currentStudent = null;
if (isset($_GET['edit'])) {
    $currentStudent = $studentObj->readById($_GET['edit']);
}

// --- Get all students ---
$allStudents = $studentObj->readAll();

// --- Display Feedback ---
if (isset($_GET['msg'])) {
    $feedback = $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 70%; margin-top: 15px; }
        table, th, td { border: 1px solid #444; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
        .msg { color: green; font-weight: bold; margin-bottom: 10px; }
        a { text-decoration: none; margin: 0 5px; }
    </style>
</head>
<body>
    <h1>📘 Student Manager</h1>

    <?php if ($feedback): ?>
        <p class="msg"><?= htmlspecialchars($feedback) ?></p>
    <?php endif; ?>

    <!-- Student Form -->
    <h2><?= $currentStudent ? "Edit Student" : "Add New Student"; ?></h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $currentStudent['id'] ?? ''; ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?= $currentStudent['name'] ?? ''; ?>" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $currentStudent['email'] ?? ''; ?>" required>
        <br><br>

        <button type="submit"><?= $currentStudent ? "Update" : "Add"; ?> Student</button>
        <?php if ($currentStudent): ?
