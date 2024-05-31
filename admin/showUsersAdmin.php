<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT full_name, section, IDNo, role FROM users";
$result = $conn->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();

$tab1 = array();
$tab2 = array();
$tab3 = array();
$tab4 = array();
$tab5 = array();

foreach ($users as $user) {
    if ($user['role'] === 'student') {
        if (!empty($user['section'])) {
            $sectionNumber = (int) $user['section'][0];
            if ($sectionNumber == 1 || $sectionNumber == 2) {
                $tab1[] = $user;
            } elseif ($sectionNumber == 3 || $sectionNumber == 4) {
                $tab2[] = $user;
            } elseif ($sectionNumber == 5 || $sectionNumber == 6) {
                $tab3[] = $user;
            }
        }
    } elseif ($user['role'] === 'instructor') {
        $tab4[] = $user;
    } elseif ($user['role'] === 'admin') {
        $tab5[] = $user;
    }
}
?>
