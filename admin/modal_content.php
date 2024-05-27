<?php
session_start();

include '../login/login.php';

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "strv";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT full_name, IDNo, section FROM users WHERE IDNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();

        $htmlContent = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Student</title>
        </head>
        <body>
            <div class='mainContainer'>
                <header>
                    <div class='imgContainer'>
                        <img src='../assets/images/students/ayaka.jpg' alt='student_image' class='mainIMG'>
                    </div>
                    <div class='infoContainer'>
                        <div class='nameContainer'>
                            <div class='info'>Name:</div>
                            ".$userData['full_name']."
                        </div>
                        <div class='idContainer'>
                            <div class='info'>ID No.</div>
                            ".$userData['IDNo']."
                        </div>
                        <div class='sectionContainer'>
                            <div class='info'>Section:</div>
                            ".$userData['section']."
                        </div>
                    </div>
                </header>
                <hr>
                <div class='changeInfoContainer'>
                    <h3>Edit User Information</h3>
                    <form id='changeInfoForm' data-id='".$userId."'>
                        <label for='newFullName'>New Full Name:</label>
                        <input type='text' id='newFullName' name='newFullName' value='".$userData['full_name']."'><br><br>
                        <label for='newIdNo'>New ID No.:</label>
                        <input type='text' id='newIdNo' name='newIdNo' value='".$userData['IDNo']."'><br><br>
                        <label for='newSection'>New Section:</label>
                        <input type='text' id='newSection' name='newSection' value='".$userData['section']."'><br><br>
                        <label for='currentPassword'>Current Password:</label>
                        <input type='password' id='currentPassword' name='currentPassword'><br><br>
                        <label for='newPassword'>New Password:</label>
                        <input type='password' id='newPassword' name='newPassword'><br><br>
                        <label for='confirmNewPassword'>Confirm New Password:</label>
                        <input type='password' id='confirmNewPassword' name='confirmNewPassword'><br><br>
                        <button type='submit' id='saveChangesBtn'>Save Changes</button>
                    </form>
                </div>
            </div>
            <script src='../student/student.js'></script>
            
        </body>
        </html>
        ";
        echo $htmlContent;
    } else {
        echo "<p>Error: User data not found.</p>";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Error: User ID not provided.</p>";
}
?>