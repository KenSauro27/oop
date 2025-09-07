<?php
class Student {
    public $name;
    public $subjects = [];
    public $feePerSubject = 1450; // PHP per subject

    // Constructor
    function __construct($name) {
        $this->name = $name;
    }

    // Enroll in a subject
    function enroll($subject) {
        $this->subjects[] = $subject;
    }

    // Drop a subject
    function drop($subject) {
        if (in_array($subject, $this->subjects)) {
            $this->subjects = array_diff($this->subjects, [$subject]);
        }
    }

    // Calculate total fee
    function totalFee() {
        return count($this->subjects) * $this->feePerSubject;
    }

    // Show details
    function showDetails() {
        echo "<b>Student:</b> {$this->name}<br>";
        echo "<b>Subjects:</b><br>";
        if (empty($this->subjects)) {
            echo "No subjects enrolled.<br>";
        } else {
            foreach ($this->subjects as $subj) {
                echo "- $subj<br>";
            }
        }
        echo "<b>Total Fee:</b> ₱" . $this->totalFee() . "<br>";
    }
}

// ---------- TESTING ----------
$s1 = new Student("Juan Dela Cruz");

// Enroll subjects
$s1->enroll("Math");
$s1->enroll("Science");
$s1->enroll("English");

// Drop one subject
$s1->drop("Science");

// Display results
$s1->showDetails();
?>
