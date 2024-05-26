<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the database
$sql = "SELECT full_name, section FROM users";
$result = $conn->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();

// Categorize users into tabs
$tab1 = array();
$tab2 = array();
$tab3 = array();

foreach ($users as $user) {
    // Check if 'section' is not empty
    if (!empty($user['section'])) {
        $sectionNumber = (int) $user['section'][0]; // Get the first character and convert it to integer
        if ($sectionNumber == 1 || $sectionNumber == 2) {
            $tab1[] = $user;
        } elseif ($sectionNumber == 3 || $sectionNumber == 4) {
            $tab2[] = $user;
        } elseif ($sectionNumber == 5 || $sectionNumber == 6) {
            $tab3[] = $user;
        }
    }
}
?>