<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputIdNo = $_POST['idNo'];
    $inputPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, full_name, section, role, imgPath, password FROM users WHERE IDNo = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("s", $inputIdNo);
    if ($bind === false) {
        die("Bind failed: " . htmlspecialchars($stmt->error));
    }

    $execute = $stmt->execute();
    if ($execute === false) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    }

    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $full_name, $section, $role, $imgPath, $hashedPassword);
        $stmt->fetch();

        if (password_verify($inputPassword, $hashedPassword)) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['section'] = $section;
            $_SESSION['idNo'] = $inputIdNo;
            $_SESSION['role'] = $role;
            $_SESSION['imgPath'] = $imgPath;

            if ($role == "student") {
                header("Location: ../student/student.php");
                exit();
            } elseif ($role == "admin") {
                header("Location: ../admin/admin.php");
                exit();
            } elseif ($role == "instructor") {
                header("Location: ../instructor/instructor.php");
                exit();
            } else {
                echo "<script>alert('Unknown role.'); window.location.href = '../index.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid ID No. or Password.'); window.location.href = '../index.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid ID No. or Password.'); window.location.href = '../index.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
