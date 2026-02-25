<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

    <title>ConceptPalace</title>
<link rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><h5>ConceptPalace</h5></a>
	
<a href="search.php" class="btn btn-sm btn-outline-light">Search</a> 
	
  <div class="ml-auto d-flex align-items-center">
    <?php if (isset($_SESSION['user_id'])): ?>
    <span class="navbar-text text-white mr-3">
        Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>
    </span>
	  
      <a href="logout.php" class="btn btn-sm btn-outline-light">Logout</a>
    <?php else: ?>
	  <a href="index.php" class="btn btn-sm btn-outline-light">Home</a>
	  <a href="artists.php" class="btn btn-sm btn-outline-light">Artists</a>
	  <a href="contact_us.php" class="btn btn-sm btn-outline-light">Contact Us</a><a href="news.php" class="btn btn-sm btn-outline-light">News and Events</a>
	  <a href="about_us.php" class="btn btn-sm btn-outline-light">About Us</a>
	  
      <a href="logintest.php" class="btn btn-sm btn-outline-light mr-2">Login</a>
      <a href="registertest.php" class="btn btn-sm btn-outline-light">Register</a>
    <?php endif; ?>

    <a href="cart.php" class="btn btn-sm btn-warning ml-3">
      Cart
    </a>
  </div>
</nav>

<div class="container mt-4">
