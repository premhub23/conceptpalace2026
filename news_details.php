<?php
$conn = mysqli_connect("localhost","root","","conceptpalace2025");

$id = $_GET['id'];

$stmt = mysqli_prepare($conn,"SELECT * FROM news_events WHERE news_events_id=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$news = mysqli_fetch_assoc($result);
?>

<h2><?php echo $news['title']; ?></h2>
<img src="<?php echo $news['news_path']; ?>" width="300">
<p><?php echo $news['body']; ?></p>