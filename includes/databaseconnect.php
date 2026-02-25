<?php

$database_url = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? getenv('DATABASE_URL');

if (!$database_url) {
    die("DATABASE_URL is not set");
}

$db = parse_url($database_url);

$dsn = sprintf(
    "pgsql:host=%s;port=%s;dbname=%s;sslmode=require",
    $db['host'],
    $db['port'] ?? 5432,
    ltrim($db['path'], '/')
);

try {
    $conn = new PDO($dsn, $db['user'], $db['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

