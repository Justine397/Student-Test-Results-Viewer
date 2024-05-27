<?php
session_start();

if (isset($_POST['userId']) && isset($_POST['newFullName']) && isset($_POST['newIdNo']) && isset($_POST['newSection']) && isset($_POST['currentPassword'])) {
    $userId = $_POST['userId'];
    $newFullName = $_POST['newFullName'];
    $newIdNo = $_POST['newIdNo'];
    $newSection = $_POST['newSection'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : null;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "strv";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT password FROM users WHERE IDNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        if (password_verify($currentPassword, $userData['password'])) {
            $updateSql = "UPDATE users SET full_name = ?, IDNo = ?, section = ? WHERE IDNo = ?";
            if ($newPassword) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateSql = "UPDATE users SET full_name = ?, IDNo = ?, section = ?, password = ? WHERE IDNo = ?";
            }

            $stmt = $conn->prepare($updateSql);

            if ($newPassword) {
                $stmt->bind_param("sssss", $newFullName, $newIdNo, $newSection, $hashedNewPassword, $userId);
            } else {
                $stmt->bind_param("ssss", $newFullName, $newIdNo, $newSection, $userId);
            }

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'User information updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update user information.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Required parameters not provided.']);
}
?>
