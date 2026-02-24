<?php
session_start();

include 'includes/databaseconnect.php';
include 'includes/header.php';

$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

$result = $conn->query("SELECT * FROM premchand ORDER BY uploaded_at DESC LIMIT $start, $limit");

if(!$result){
    die("Main Query Error: " . $conn->error);
}

$totalQuery = $conn->query("SELECT COUNT(*) as total FROM jonathan");

if(!$totalQuery){
    die("Count Query Error: " . $conn->error);
}

$total = $totalQuery->fetch_assoc()['total'];
$pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html>
<head>
<title>Advanced Gallery</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.gallery-img { cursor:pointer; height:200px; object-fit:cover; }
</style>
</head>
<body class="bg-light">

<div class="container mt-5">
<h2 class="text-center mb-4">Premchand Budhooram Image Gallery</h2>
<div class="row">

<?php if($result && $result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>

<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
<div class="card">
<img src="<?php echo $row['image_path']; ?>" 
     class="card-img-top gallery-img"
     data-id="<?php echo $row['premchand_id']; ?>"
     data-title="<?php echo $row['image_name']; ?>"
     data-image="<?php echo $row['image_path']; ?>">

</div>
</div>
    <?php endwhile; ?>
<?php else: ?>
    <p class="text-center">No images found.</p>
<?php endif; ?>


</div>

<!-- Pagination -->
<nav>
<ul class="pagination justify-content-center">
<?php for($i=1; $i<=$pages; $i++): ?>
<li class="page-item <?php if($page==$i) echo 'active'; ?>">
<a class="page-link" href=""></a>
</li>
<?php endfor; ?>
</ul>
</nav>

</div>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-body text-center">
<h5 id="modalTitle"></h5>
<img src="" id="modalImage" class="img-fluid">
<br><br>
<button class="btn btn-secondary" id="prevBtn">Prev</button>
<button class="btn btn-secondary" id="nextBtn">Next</button>
</div>
</div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
var images = [];
$('.gallery-img').each(function(){
images.push({
id: $(this).data('id'),
title: $(this).data('title'),
src: $(this).data('image')
});
});

var currentIndex = 0;

$('.gallery-img').click(function(){
var id = $(this).data('id');
currentIndex = images.findIndex(img => img.id == id);
showImage();
$('#lightboxModal').modal('show');
});

function showImage(){
$('#modalImage').attr('src', images[currentIndex].src);
$('#modalTitle').text(images[currentIndex].title);
}

$('#nextBtn').click(function(){
currentIndex = (currentIndex + 1) % images.length;
showImage();
});

$('#prevBtn').click(function(){
currentIndex = (currentIndex - 1 + images.length) % images.length;
showImage();
});

$('.editBtn').click(function(){
$('#editId').val($(this).data('id'));
$('#editTitle').val($(this).data('title'));
$('#editModal').modal('show');
});
</script>

	<?php
	include 'includes/footer.php';
	?>
</body>
</html>
