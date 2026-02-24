<?php
include 'includes/databaseconnect.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM news_events ORDER BY date DESC");

if(!$result){
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>News & Events</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.news-img {
    height: 220px;
    object-fit: cover;
}
</style>
</head>
<body class="bg-light">

<div class="container mt-5">

<h2 class="text-center mb-4">News & Events</h2>

<div class="row">

<?php if($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>

<div class="col-md-6 mb-4">
<div class="card shadow-sm h-100">

<?php if(!empty($row['news_path'])): ?>
<img src="<?php echo $row['news_path']; ?>" 
     class="card-img-top news-img">
<?php endif; ?>

<div class="card-body">
<h5 class="card-title"><?php echo $row['title']; ?></h5>

<p class="card-text">
<?php echo substr(strip_tags($row['body']), 0, 120); ?>...
</p>

<a href="newsdetails.php?id=<?php echo $row['news_events_id']; ?>" 
   class="btn btn-primary btn-sm">
Read More
</a>

</div>

<div class="card-footer text-muted">
<?php echo date("F d, Y", strtotime($row['date'])); ?>
</div>

</div>
</div>

    <?php endwhile; ?>
<?php else: ?>
    <p class="text-center">No news available.</p>
<?php endif; ?>

</div>
</div>
	

</body>
</html>
