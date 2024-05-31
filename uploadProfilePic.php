<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strv";

$logFile = 'upload_log.txt'; // Log file for debugging

// Function to write logs
function writeLog($message) {
    global $logFile;
    $message = date('Y-m-d H:i:s') . " - " . $message . "\n";
    file_put_contents($logFile, $message, FILE_APPEND);
}

// Check if the request method is POST and if the necessary fields are set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic']) && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    writeLog("Received upload request from user ID: $userId");

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        writeLog("Database connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }

    $uploadDir = 'assets/images/upload/';
    $fileName = basename($_FILES['profile_pic']['name']);
    $uploadFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Check if the uploaded file is of an allowed type
    if (in_array($imageFileType, $allowedTypes)) {
        writeLog("File type is allowed: $imageFileType");

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
            writeLog("File successfully uploaded to: $uploadFile");

            // Store only the filename in the database
            $imgPath = $fileName;

            // Update the imgPath in the database
            $stmt = $conn->prepare("UPDATE users SET imgPath = ? WHERE IDNo = ?");
            $stmt->bind_param('ss', $imgPath, $userId);

            if ($stmt->execute()) {
                $_SESSION['imgPath'] = $imgPath; // Update the session variable
                writeLog("Database updated successfully for user ID: $userId");
                echo json_encode(['success' => true, 'filename' => $imgPath]);
            } else {
                writeLog("Failed to update database for user ID: $userId. Error: " . $stmt->error);
                echo json_encode(['success' => false, 'message' => 'Failed to save in database']);
            }

            $stmt->close();
        } else {
            writeLog("Failed to move uploaded file to target directory");
            echo json_encode(['success' => false, 'message' => 'Failed to upload file']);
        }
    } else {
        writeLog("Invalid file type: $imageFileType");
        echo json_encode(['success' => false, 'message' => 'Invalid file type']);
    }

    $conn->close();
} else {
    writeLog("Invalid request");
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
