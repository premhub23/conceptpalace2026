<?php
session_start();
include 'includes/databaseconnect.php';
include 'includes/header.php';


if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h4>Your cart is empty.</h4>";
    include 'includes/footer.php';
    exit;
}


$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}


if (isset($_POST['place_order'])) {

    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (total) VALUES (?)");
    $stmt->bind_param("d", $total);
    $stmt->execute();

    $order_id = $stmt->insert_id;

    // Insert order items
    $stmt = $conn->prepare(
        "INSERT INTO order_items (order_id, product_id, quantity, price)
         VALUES (?, ?, ?, ?)"
    );

    foreach ($_SESSION['cart'] as $product_id => $item) {
        $stmt->bind_param(
            "iiid",
            $order_id,
            $product_id,
            $item['quantity'],
            $item['price']
        );
        $stmt->execute();
    }

    $updateStock = $conn->prepare(
    "UPDATE products SET quantity = quantity - ? WHERE product_id = ?"
);

foreach ($_SESSION['cart'] as $product_id => $item) {
    $updateStock->bind_param("ii", $item['quantity'], $product_id);
    $updateStock->execute();
}

	
	// Clear cart
    unset($_SESSION['cart']);

    echo "<div class='alert alert-success'>
            Order placed successfully! Your Order ID is <strong>$order_id</strong>
          </div>";
}

?>


<h3 class="mb-4">Checkout</h3>

<table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th>Product</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($_SESSION['cart'] as $item): ?>
    <tr>
      <td><?php echo htmlspecialchars($item['name']); ?></td>
      <td><?php echo $item['quantity']; ?></td>
      <td>$<?php echo $item['price']; ?></td>
      <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<form method="post">
  <button type="submit" name="place_order" class="btn btn-dark btn-lg mt-3">
    <h4>Grand Total:<strong>$<?php echo number_format($total, 2); ?></strong></h4>
    Place Order
  </button>
</form>

<?php include 'includes/footer.php'; ?>