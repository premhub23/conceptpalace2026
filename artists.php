<?php
include 'includes/databaseconnect.php';
include 'includes/header.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ConceptPalace</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.artist-card img {
    height: 250px;
    object-fit: cover;
}
.artist-card {
    transition: 0.3s ease;
}
.artist-card:hover {
    transform: scale(1.03);
}
</style>
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">Welcome to ConceptPalace</h2>
    <p class="text-center mb-5">Featured Artists</p>

    <div class="row">

        <!-- Premchand -->
        <div class="col-md-4 mb-4">
            <div class="card artist-card shadow-sm">
                <a href="premgallery.php">
                    <img src="assets/premchand/Manticore_Inks.jpg" 
                         class="card-img-top img-fluid" 
                         alt="Manticore Inks">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Premchand</h5>
                </div>
            </div>
        </div>

        <!-- Ansil -->
        <div class="col-md-4 mb-4">
            <div class="card artist-card shadow-sm">
                <a href="ansilgallery.php">
                    <img src="assets/ansil/PropThor.jpg" 
                         class="card-img-top img-fluid" 
                         alt="Thor Proposal">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Ansil Quow</h5>
                </div>
            </div>
        </div>

        <!-- Jonathan -->
        <div class="col-md-4 mb-4">
            <div class="card artist-card shadow-sm">
                <a href="jongallery.php">
                    <img src="assets/jonathan/IMG_20190805_075748_950.jpg" 
                         class="card-img-top img-fluid" 
                         alt="Dog Men">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Jonathan Providence</h5>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
