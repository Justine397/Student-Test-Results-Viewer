<?php
session_start();

include '../login/login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFullName = htmlspecialchars(trim($_POST["newFullName"]));
    $newIdNo = htmlspecialchars(trim($_POST["newIdNo"]));
    $newSection = htmlspecialchars(trim($_POST["newSection"]));
    $currentPassword = htmlspecialchars(trim($_POST["currentPassword"]));
    $newPassword = htmlspecialchars(trim($_POST["newPassword"]));
    $confirmNewPassword = htmlspecialchars(trim($_POST["confirmNewPassword"]));

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "strv";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (password_verify($currentPassword, $_SESSION['password'])) {
        if ($newPassword === $confirmNewPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET full_name=?, IDNo=?, section=?, password=? WHERE IDNo=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $newFullName, $newIdNo, $newSection, $hashedPassword, $_SESSION['IDNo']);

            if ($stmt->execute()) {
                echo "User data updated successfully.";
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Error: New password and confirm new password do not match.";
        }
    } else {
        echo "Error: Current password is incorrect.";
    }

    $conn->close();
} else {
    echo "Error: Form data not submitted.";
}
?>
