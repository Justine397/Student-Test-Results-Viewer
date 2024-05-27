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

$userId = $_SESSION['id'];
$year = $_GET['year'];

$query = "SELECT g.*, u.full_name AS instructor_name FROM grades g 
          JOIN users u ON g.instructor_id = u.id 
          WHERE g.student_id = ? AND g.year = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $userId, $year);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    $grades = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $grades = array();
}

echo json_encode($grades);
?>