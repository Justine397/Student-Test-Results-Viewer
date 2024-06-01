<?php
session_start();

include '../login/login.php';

$userData = [];
$imgPath = "../assets/images/default.jpg";

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

    $query = $conn->prepare("SELECT * FROM users WHERE IDNo = ?");
    $query->bind_param('s', $userId);
    $query->execute();
    $result = $query->get_result();
    $userData = $result->fetch_assoc();

    if ($userData) {
        if (!empty($userData['imgPath'])) {
            $imgPath = "../assets/images/upload/" . htmlspecialchars($userData['imgPath']);
        }
    } else {
        echo "User not found.";
        exit();
    }

    $query->close();
    $conn->close();
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src='../assets/admin.js'></script>
    <style>
    .changeInfoContainer {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f4f4f4;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .changeInfoContainer h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .changeInfoContainer label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    .changeInfoContainer input[type="text"],
    .changeInfoContainer input[type="password"] {
        width: calc(100% - 16px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 16px;
        font-size: 16px;
    }

    .changeInfoContainer button {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .changeInfoContainer button:hover {
        background-color: #45a049;
    }

    #cancelBTN {
        background-color: #bbb;
        color: #fff;
        margin-top: 10px;
    }

    #cancelBTN:hover {
        background-color: #999;
    }

    @media only screen and (max-width: 600px) {
        .changeInfoContainer {
            max-width: 100%;
            border-radius: 0;
            box-shadow: none;
            border: none;
        }

        .changeInfoContainer input[type="text"],
        .changeInfoContainer input[type="password"] {
            width: 100%;
        }
    }

    </style>
</head>
<body>
    <div class='mainContainer'>
        <header>
            <div class='imgContainer'>
                <img src='<?php echo $imgPath; ?>' alt='student_image' class='mainIMG'>
            </div>
            <div class='infoContainer'>
                <div class='nameContainer'>
                    <div class='info'>Name:</div>
                    <?php echo htmlspecialchars($userData['full_name']); ?>
                </div>
                <div class='idContainer'>
                    <div class='info'>ID No.</div>
                    <?php echo htmlspecialchars($userData['IDNo']); ?>
                </div>
                <div class='sectionContainer'>
                    <div class='info'>Section:</div>
                    <?php echo htmlspecialchars($userData['section']); ?>
                </div>
            </div>
        </header>
        <hr>
        <div class='changeInfoContainer'>
            <h3>Edit User Information</h3>
            <form id='changeInfoForm' action='update_user.php' method='post'>
                <input type='hidden' id='userId' name='userId' value='<?php echo htmlspecialchars($userId); ?>'>
                <label for='newFullName'>New Full Name:</label>
                <input type='text' id='newFullName' name='newFullName' value='<?php echo htmlspecialchars($userData['full_name']); ?>'><br><br>
                <label for='newIdNo'>New ID No.:</label>
                <input type='text' id='newIdNo' name='newIdNo' value='<?php echo htmlspecialchars($userData['IDNo']); ?>'><br><br>
                <label for='newSection'>New Section:</label>
                <input type='text' id='newSection' name='newSection' value='<?php echo htmlspecialchars($userData['section']); ?>'><br><br>
                <label for='newPassword'>New Password:</label>
                <input type='password' id='newPassword' name='newPassword'><br><br>

                <button type='submit' id='saveChangesBtn'>Save Changes</button>
            </form>
        </div>

    </div>
    <script src='../student/student.js'></script>
</body>
</html>
