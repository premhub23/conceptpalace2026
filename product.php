<?php
session_start();

include 'includes/databaseconnect.php';
include 'includes/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product not found.");
}

$product_id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

if (isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'image' => $product['image']
        ];
    }
$_SESSION['cart'][1] = [
    'name' => 'Test Product',
    'price' => 100,
    'quantity' => 1,
    'image' => 'test.jpg'
];

    header("Location: cart.php");
    exit;
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>" 
                 class="img-fluid">
        </div>

        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <h4>$<?php echo number_format($product['price'], 2); ?></h4>
            <p><?php echo htmlspecialchars($product['description']); ?></p>

            <form method="POST">
                <button type="submit" name="add_to_cart" class="btn btn-dark btn-lg">
                    Add to Cart
                </button>
            </form>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
