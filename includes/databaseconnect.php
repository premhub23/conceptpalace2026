
<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER'); 
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: 5432;

$dsn = "pgsql:host=$host;port=$port;dbname=$database";
$conn = new PDO($dsn, $user, $password);
?>





