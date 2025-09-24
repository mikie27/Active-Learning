<?php
$servername = "127.0.0.1"; // Use "localhost" or your server's IP
$username = "root";         // Your MySQL username
$password = "";       // Your MySQL password
$dbname = "grocerific";      // The database name
$port = 3306;               // Default MySQL port is 3306

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}
