<?php
session_start();

include 'includes/databaseconnect.php';
include 'includes/header.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT product_id, name, price, image FROM products ORDER BY created DESC LIMIT 9");
$stmt->execute();
$result = $stmt->get_result();


if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<h3 class="mb-4">Featured Products</h3>

<div class="row">
<?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="assets/images/<?php echo htmlspecialchars($row['image']); ?>" 
             class="card-img-top"
             alt="<?php echo htmlspecialchars($row['name']); ?>">
        <div class="card-body">
          <h5 class="card-title">
            <?php echo htmlspecialchars($row['name']); ?>
          </h5>
          <p class="card-text">
            $<?php echo number_format($row['price'], 2); ?>
          </p>
          <a href="product.php?id=<?php echo (int)$row['product_id']; ?>" 
             class="btn btn-dark btn-block">
            View Product
          </a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php else: ?>
  <p>No products found.</p>
<?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
