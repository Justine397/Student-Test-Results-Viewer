
<?php

$mysqli = new mysqli('localhost', 'root', '', 'strv');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Query to get the counts for each category
$query = "SELECT COUNT(*) AS count, role FROM users GROUP BY role";

$result = $mysqli->query($query);

if ($result) {
    // Create an associative array to store the counts
    $counts = array();

    while ($row = $result->fetch_assoc()) {
        $counts[$row['role']] = $row['count'];
    }

    // Close the result set
    $result->close();
} else {
    echo "Error executing the query: " . $mysqli->error;
}

// Close connection
$mysqli->close();
?>