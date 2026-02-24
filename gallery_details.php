<?php
$conn = mysqli_connect("localhost","root","","conceptpalace2025");

$type = $_GET['type'];
$id = $_GET['id'];

$table = $type; // safe because it comes from controlled UNION types

$query = "SELECT * FROM $table WHERE ".$type."_id=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$image = mysqli_fetch_assoc($result);
?>

<h2><?php echo $image['image_name']; ?></h2>
<img src="<?php echo $image['image_path']; ?>" width="400">