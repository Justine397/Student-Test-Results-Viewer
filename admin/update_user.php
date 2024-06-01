<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $newFullName = $_POST['newFullName'];
    $newIdNo = $_POST['newIdNo'];
    $newSection = $_POST['newSection'];
    $newPassword = $_POST['newPassword'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "strv";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $query = $conn->prepare("UPDATE users SET full_name = ?, IDNo = ?, section = ?, password = ? WHERE IDNo = ?");
        $query->bind_param('sssss', $newFullName, $newIdNo, $newSection, $hashedPassword, $userId);
    } else {
        $query = $conn->prepare("UPDATE users SET full_name = ?, IDNo = ?, section = ? WHERE IDNo = ?");
        $query->bind_param('ssss', $newFullName, $newIdNo, $newSection, $userId);
    }

    if ($query->execute()) {
        echo "<script>alert('User information updated successfully'); window.location.href = 'admin.php';</script>";
    } else {
        echo "Error updating user information: " . $conn->error;
    }

    $query->close();
    $conn->close();
}
?>
