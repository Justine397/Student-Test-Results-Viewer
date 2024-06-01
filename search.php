<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_POST['query']) ? $_POST['query'] : '';

$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if (!empty($query)) {
    if ($user_role === 'instructor') {
        $stmt = $conn->prepare("SELECT full_name, section FROM users WHERE role = 'student' AND (full_name LIKE ? OR section LIKE ?)");
    } else {
        $stmt = $conn->prepare("SELECT full_name, section FROM users WHERE full_name LIKE ? OR section LIKE ?");
    }

    $searchTerm = "%".$query."%";
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = '';
    while ($row = $result->fetch_assoc()) {
        $output .= '<div>' . htmlspecialchars($row['full_name']) . '  ' . htmlspecialchars($row['section']) . '</div>';
    }

    if (empty($output)) {
        $output = 'No results found.';
    }

    echo $output;
    $stmt->close();
}

$conn->close();
?>

