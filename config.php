<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, full_name, IDNo, role, password, created_at FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["full_name"] . " - ID No: " . $row["IDNo"] . " - role: " . $row["role"] . " - Created At: " . $row["created_at"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
