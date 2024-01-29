<?php
//$hostname = "app-db-1"; 
//$serverName = "192.168.1.111";
//$dbUsername = "root";
//$dbPassword = "root";
//$dbName = "project1";
//$port=3306;
//
$serverName = getenv('DB_HOST') ?: '127.0.0.1';
$dbUsername = getenv('DB_USER') ?: 'root';
$dbPassword = getenv('DB_PASSWORD') ?: 'root';
$dbName = getenv('DB_NAME') ?: 'project1';
$port = getenv('DB_PORT') ?: 3306;


// Create a connection
$conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName,$port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//
//echo "Connected successfully";
//
//// Close the connection
//$conn->close();

