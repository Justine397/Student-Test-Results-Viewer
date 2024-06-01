<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "strv";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
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
        $studentIDNo = $gradeData[5];

        // Fetch the numeric student_id using the IDNo
        $stmtSelect = $conn->prepare("SELECT id FROM users WHERE IDNo = ?");
        $stmtSelect->bind_param("s", $studentIDNo);
        $stmtSelect->execute();
        $stmtSelect->bind_result($studentId);
        $stmtSelect->fetch();
        $stmtSelect->close();

        if ($studentId) {
            echo "Session ID: " . $_SESSION['id'] . "<br>";
            echo "Student ID: " . $studentId . "<br>";

            // Check if the grade entry exists before updating
            $checkSql = "SELECT * FROM grades WHERE subject = ? AND instructor_id = ? AND student_id = ?";
            $stmtCheck = $conn->prepare($checkSql);
            $stmtCheck->bind_param("sss", $subject, $_SESSION['id'], $studentId);
            $stmtCheck->execute();
            $result = $stmtCheck->get_result();
            if ($result->num_rows > 0) {
                // Update the grades
                $updateSql = "UPDATE grades SET first_semester_grade = ?, second_semester_grade = ?, final_grade = ? 
                              WHERE subject = ? AND instructor_id = ? AND student_id = ?";
                $stmtUpdate = $conn->prepare($updateSql);
                $stmtUpdate->bind_param("ssssss", $firstSemesterGrade, $secondSemesterGrade, $finalGrade, $subject, $_SESSION['id'], $studentId);
                $stmtUpdate->execute();

                if ($stmtUpdate->affected_rows === 1) {
                    echo "Grades for $subject updated successfully.<br>";
                } else {
                    echo "Error updating grades for $subject. Affected rows: " . $stmtUpdate->affected_rows . "<br>";
                    echo "Error: " . $stmtUpdate->error . "<br>";
                }

                $stmtUpdate->close();
            } else {
                echo "No existing grade entry found for subject $subject, instructor ID " . $_SESSION['id'] . ", and student ID $studentId.<br>";
            }
            $stmtCheck->close();
        } else {
            echo "Error: Student with IDNo $studentIDNo not found.<br>";
        }
    }
    
    $conn->close();
} else {
    echo "Error: This script accepts only POST requests.";
}
?>
