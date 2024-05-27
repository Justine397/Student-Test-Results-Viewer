<?php
// Start the session
session_start();

// Include login.php file
include '../login/login.php';

// Check if the userId parameter is provided
if(isset($_GET['userId'])) {
    // Get the user ID from the parameter
    $userId = $_GET['userId'];

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

    // Prepare and execute SQL statement to retrieve user data
    $sql = "SELECT full_name, idNo, section FROM users WHERE idNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user data exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $userData = $result->fetch_assoc();

        // HTML content generation based on user data
        $htmlContent = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Student</title>
            
        </head>
        <body>
            <div class="mainContainer"> 
                <header>
                    <div class="imgContainer">
                        <img src="../assets/images/students/ayaka.jpg" alt="student_image" class="mainIMG">
                    </div>
                    <div class="infoContainer">
                        <div class="nameContainer">
                            <div class="info">Name:</div>
                            '.$userData['full_name'].'
                        </div>
                        <div class="idContainer">
                            <div class="info">ID No.</div>
                            '.$userData['idNo'].'
                        </div>
                        <div class="sectionContainer">
                            <div class="info">Section:</div>
                            '.$userData['section'].'
                        </div>

                    </div>
                </header>
                <hr>
                </div>
                <div class="changeInfoContainer">
                <h3>Edit User Information</h3>
                <form id="changeInfoForm" data-id="USER_ID">
                    <label for="newFullName">New Full Name:</label>
                    <input type="text" id="newFullName" name="newFullName"><br><br>
                    <label for="newIdNo">New ID No.:</label>
                    <input type="text" id="newIdNo" name="newIdNo"><br><br>
                    <label for="newSection">New Section:</label>
                    <input type="text" id="newSection" name="newSection"><br><br>
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" id="currentPassword" name="currentPassword"><br><br>
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword"><br><br>
                    <label for="confirmNewPassword">Confirm New Password:</label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword"><br><br>
                    <button type="submit" id="saveChangesBtn">Save Changes</button>
                </form>
            </div>
            </div>
            <script src="../student/student.js"></script>
            <script src="../assets/modalContent.js"></script>
        </body>
        
        </html>
        ';

        // Output the HTML content
        echo $htmlContent;
    } else {
        // If user data not found, return an error message
        echo "<p>Error: User data not found.</p>";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If user ID is not provided, return an error message
    echo "<p>Error: User ID not provided.</p>";
}
?>
