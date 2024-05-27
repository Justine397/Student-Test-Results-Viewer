<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "strv";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');
    $gradesData = json_decode($jsonData, true);

    foreach ($gradesData as $gradeData) {
        $instructorName = $gradeData[0];
        $subject = $gradeData[1];
        $firstSemesterGrade = $gradeData[2];
        $secondSemesterGrade = $gradeData[3];
        $finalGrade = $gradeData[4];
        $studentId = $gradeData[5];
    
        echo "Session ID: " . $_SESSION['id'] . "<br>";
        echo "Student ID: " . $studentId . "<br>";
    
        $updateSql = "UPDATE grades SET first_semester_grade = ?, second_semester_grade = ?, final_grade = ? 
                      WHERE subject = ? AND instructor_id = ? AND student_id = ?";
        $stmtUpdate = $conn->prepare($updateSql);
        $stmtUpdate->bind_param("ssssss", $firstSemesterGrade, $secondSemesterGrade, $finalGrade, $subject, $_SESSION['id'], $studentId);
        $stmtUpdate->execute();
    
        if ($stmtUpdate->affected_rows === 1) {
            echo "Grades for $subject updated successfully.<br>";
        } else {
            echo "Error updating grades for $subject.<br>";
        }
    
        $stmtUpdate->close();
    }
    
    $conn->close();
} else {
    echo "Error: This script accepts only POST requests.";
}

?>
