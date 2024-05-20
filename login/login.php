<?php
// login.php should not start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputIdNo = $_POST['idNo'];
    $inputPassword = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, full_name, section, role, password FROM users WHERE IDNo = ?");
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
        $stmt->bind_result($id, $full_name, $section, $role, $hashedPassword);
        $stmt->fetch();

        if (password_verify($inputPassword, $hashedPassword)) {
            // Password is correct, start a new session and save user info
            session_start(); // Start the session here
            $_SESSION['id'] = $id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['section'] = $section;
            $_SESSION['idNo'] = $inputIdNo;

            // Redirect based on user role
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
                // Unknown role, trigger pop-up message and redirect back to login
                echo "<script>alert('Unknown role.'); window.location.href = 'index.html';</script>";
            }
        } else {
            // Invalid password, trigger pop-up message and redirect back to login
            echo "<script>alert('Invalid ID No. or Password.'); window.location.href = 'index.html';</script>";
        }
    } else {
        // No user found with that ID No., trigger pop-up message and redirect back to login
        echo "<script>alert('Invalid ID No. or Password.'); window.location.href = 'index.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
