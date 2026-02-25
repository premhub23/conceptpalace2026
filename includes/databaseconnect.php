<?php

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];
$database_url = $_ENV['DATABASE_URL'];
	
$conn = new mysqli($servername, $username, $password, $database, $database_url);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>



