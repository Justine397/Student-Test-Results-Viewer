<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['wholeName'];
    $idNo = $_POST['idNo'];
    $section = $_POST['section'];
    $password = $_POST['password'];
    $role = $_POST['role']; 
    
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE IDNo = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("s", $idNo);
    if ($bind === false) {
        die("Bind failed: " . htmlspecialchars($stmt->error));
    }

    $execute = $stmt->execute();
    if ($execute === false) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    }

    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        
        echo "<script>alert('ID No. already exists. Please use a different ID No.'); window.location.href = 'register.html';</script>";
    } else {
        
        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (full_name, IDNo, section, password, role) VALUES (?, ?, ?, ?, ?)"); // Modified query to include role
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        $bind = $stmt->bind_param("sssss", $fullName, $idNo, $section, $hashedPassword, $role); // Modified to bind role parameter
        if ($bind === false) {
            die("Bind failed: " . htmlspecialchars($stmt->error));
        }

        $execute = $stmt->execute();
        if ($execute === false) {
            die("Execute failed: " . htmlspecialchars($stmt->error));
        }

        echo "<script>alert('Registration successful!'); window.location.href = '../login/index.html';</script>";
        $stmt->close();
    }
}

$conn->close();
?>
