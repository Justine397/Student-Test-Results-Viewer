<?php
// Start the session
session_start();

// Include login.php file
include '../login/login.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $newFullName = htmlspecialchars(trim($_POST["newFullName"]));
    $newIdNo = htmlspecialchars(trim($_POST["newIdNo"]));
    $newSection = htmlspecialchars(trim($_POST["newSection"]));
    $currentPassword = htmlspecialchars(trim($_POST["currentPassword"]));
    $newPassword = htmlspecialchars(trim($_POST["newPassword"]));
    $confirmNewPassword = htmlspecialchars(trim($_POST["confirmNewPassword"]));

    // Database connection parameters
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

    // Check if the current password matches the one in the session
    if (password_verify($currentPassword, $_SESSION['password'])) {
        // Check if the new password and confirm new password match
        if ($newPassword === $confirmNewPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Prepare and execute SQL statement to update user data
            $sql = "UPDATE users SET full_name=?, IDNo=?, section=?, password=? WHERE IDNo=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $newFullName, $newIdNo, $newSection, $hashedPassword, $_SESSION['IDNo']);

            if ($stmt->execute()) {
                // User data updated successfully
                echo "User data updated successfully.";
            } else {
                // Error updating user data
                echo "Error: " . $conn->error;
            }

            // Close statement and database connection
            $stmt->close();
        } else {
            // New password and confirm new password do not match
            echo "Error: New password and confirm new password do not match.";
        }
    } else {
        // Current password is incorrect
        echo "Error: Current password is incorrect.";
    }

    // Close database connection
    $conn->close();
} else {
    // If form data is not submitted, return an error message
    echo "Error: Form data not submitted.";
}
?>
