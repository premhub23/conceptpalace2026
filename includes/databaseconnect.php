<?php

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER']; 
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'] ?? 5432;
	
$conn = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>




