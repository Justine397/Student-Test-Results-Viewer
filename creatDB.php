<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Connect to MySQL server
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS sms";
    $conn->exec($sql);
    echo "Database created successfully<br>";

    // Connect to the sms database
    $conn->exec("use sms");

    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        IDNo VARCHAR(50) NOT NULL,
        role ENUM('student', 'instructor', 'admin') NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Table users created successfully<br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
