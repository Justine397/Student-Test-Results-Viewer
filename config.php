<?php
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

// SQL query to select data from the users table
$sql = "SELECT id, full_name, IDNo, role, password, created_at FROM users";
$result = $conn->query($sql);

// Check if there are results and output data of each row
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["full_name"] . " - ID No: " . $row["IDNo"] . " - role: " . $row["role"] . " - Created At: " . $row["created_at"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
