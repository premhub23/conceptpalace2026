<?php
include 'includes/databaseconnect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id <= 0){
    die("Invalid news ID.");
}

$result = $conn->query("SELECT * FROM news_events WHERE news_events_id = $id");

if(!$result || $result->num_rows == 0){
    die("News not found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $row['title']; ?></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">

<h2><?php echo $row['title']; ?></h2>

<p class="text-muted">
<?php echo date("F d, Y", strtotime($row['date'])); ?>
</p>

<?php if(!empty($row['news_path'])): ?>
<img src="<?php echo $row['news_path']; ?>" 
     class="img-fluid mb-4">
<?php endif; ?>

<p><?php echo nl2br($row['body']); ?></p>

<a href="news.php" class="btn btn-secondary mt-3">
Back to News
</a>

</div>

</body>
</html>
