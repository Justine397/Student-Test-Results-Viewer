<?php
if(isset($_GET['IDNo'])) {

    $mysqli = new mysqli('localhost', 'root', '', 'strv');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $query = "DELETE FROM users WHERE IDNo = ?";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $_GET['IDNo']);

        if ($stmt->execute()) {
            echo "<script>alert('User " . $_GET['IDNo'] . " has been successfully removed.'); window.location.href = 'admin.php';</script>";
        } else {
            echo "Error executing the query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Invalid or missing IDNo.";
}
?>