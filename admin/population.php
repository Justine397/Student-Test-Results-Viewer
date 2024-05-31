
<?php

$mysqli = new mysqli('localhost', 'root', '', 'strv');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$query = "SELECT COUNT(*) AS count, role FROM users GROUP BY role";

$result = $mysqli->query($query);

if ($result) {
    $counts = array();

    while ($row = $result->fetch_assoc()) {
        $counts[$row['role']] = $row['count'];
    }

    $result->close();
} else {
    echo "Error executing the query: " . $mysqli->error;
}

$mysqli->close();
?>