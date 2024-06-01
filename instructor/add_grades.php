<?php
session_start();

if (isset($_POST['subject'], $_POST['firstSemesterGrade'], $_POST['secondSemesterGrade'], $_POST['finalGrade'], $_POST['userData'])) {
    $subject = $_POST['subject'];
    $firstSemesterGrade = $_POST['firstSemesterGrade'];
    $secondSemesterGrade = $_POST['secondSemesterGrade'];
    $finalGrade = $_POST['finalGrade'];
    
    $userData = json_decode($_POST['userData'], true);

    $section = isset($userData['section']) ? $userData['section'] : '';

    if (preg_match('/^\d/', $section, $matches)) {
        $gradeNumber = (int)$matches[0];
        if ($gradeNumber >= 1 && $gradeNumber <= 2) {
            $year = 1;
        } elseif ($gradeNumber >= 3 && $gradeNumber <= 4) {
            $year = 2;
        } elseif ($gradeNumber >= 5 && $gradeNumber <= 6) {
            $year = 3;
        } else {
            $year = null;
        }
    } else {
        $year = null;
    }

    if ($year !== null && isset($_SESSION['id'])) {
        $instructorId = $_SESSION['id'];

        $studentId = $userData['id'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "strv";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $insertSql = "INSERT INTO grades (instructor_id, student_id, year, subject, first_semester_grade, second_semester_grade, final_grade) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("sssssss", $instructorId, $studentId, $year, $subject, $firstSemesterGrade, $secondSemesterGrade, $finalGrade);

        if ($stmt->execute()) {
            echo "<script>alert('Grades added successfully'); history.back();</script>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Error: User ID not found in session or invalid year.</p>";
    }
} else {
    echo "<p>Error: Required fields are missing.</p>";
}
?>