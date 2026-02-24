<?php
session_start();   // ALWAYS FIRST

include 'includes/databaseconnect.php';
include 'includes/header.php';


// Handle update cart
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $product_id => $qty) {
        $qty = (int)$qty;

        if ($qty <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $qty;
        }
    }
}


// Handle remove item
if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit;
}


// Show success message
if (!empty($_SESSION['success'])) {
    echo "<div class='alert alert-success'>";
    echo $_SESSION['success'];
    echo "</div>";
    unset($_SESSION['success']);
}


// Check if cart empty AFTER updates
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h4>Your cart is empty.</h4>";
	include 'includes/footer.php';
    exit;
}

?>

<h3 class="mb-4">Your Shopping Cart</h3>

<form method="post">
<table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th>Artwork</th>
      <th>Price</th>
      <th width="120">Quantity</th>
      <th>Total</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
  <?php
    $grand_total = 0;
    foreach ($_SESSION['cart'] as $id => $item):
      $total = $item['price'] * $item['quantity'];
      $grand_total += $total;
  ?>
    <tr>
      <td>
        <img src="assets/images/<?php echo htmlspecialchars($item['image']); ?>" width="50">
        <?php echo htmlspecialchars($item['name']); ?>
      </td>
      <td>$<?php echo number_format($item['price'], 2); ?></td>
      <td>
        <input type="number"
               name="quantities[<?php echo $id; ?>]"
               value="<?php echo $item['quantity']; ?>"
               min="0"
               class="form-control">
      </td>
      <td>$<?php echo number_format($total, 2); ?></td>
      <td>
        <a href="cart.php?remove=<?php echo $id; ?>"
           class="btn btn-danger btn-sm">
           Remove
        </a>

      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<button type="submit" name="update_cart" class="btn btn-secondary">
  Update Cart
</button>

<a href="checkouttest.php" class="btn btn-dark float-right">
  Proceed to Checkout
</a>
</form>

<h4 class="mt-4">
  Grand Total: <strong>$<?php echo number_format($grand_total, 2); ?></strong>
</h4>

<?php include 'includes/footer.php'; ?>