<?php

$database_url = getenv('DATABASE_URL');

if (!$database_url) {
    die("DATABASE_URL is not set");
}

$db = parse_url($database_url);

$host = $db['host'];
$port = $db['port'] ?? 5432;
$user = $db['user'];
$password = $db['pass'];
$dbname = ltrim($db['path'], '/');

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    $conn = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>



