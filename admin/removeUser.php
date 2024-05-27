<?php
// Check if IDNo is provided
if(isset($_GET['IDNo'])) {
    // Assuming you've already connected to your MySQL database
    // Replace 'localhost', 'username', 'password', and 'database_name' with your actual credentials
    $mysqli = new mysqli('localhost', 'root', '', 'strv');

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Prepare a DELETE statement
    $query = "DELETE FROM users WHERE IDNo = ?";

    if ($stmt = $mysqli->prepare($query)) {
        // Bind IDNo parameter
        $stmt->bind_param("s", $_GET['IDNo']);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "<script>alert('User " . $_GET['IDNo'] . " has been successfully removed.'); window.location.href = 'admin.php';</script>";
        } else {
            echo "Error executing the query: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
} else {
    echo "Invalid or missing IDNo.";
}
?>
