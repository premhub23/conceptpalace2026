<?php
session_start();
require 'includes/databaseconnect.php';

$errors = [];
$success = "";

if (!isset($_GET['token'])) {
    die("Invalid request.");
}

$token = $_GET['token'];

// Validate token
$stmt = $conn->prepare("
    SELECT user_id 
    FROM users 
    WHERE reset_token = ? 
    AND reset_expires > NOW()
    LIMIT 1
");

$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Invalid or expired token.");
}

$user = $result->fetch_assoc();
$user_id = $user['user_id'];

// Handle password reset submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $update = $conn->prepare("
            UPDATE users 
            SET password = ?, 
                reset_token = NULL, 
                reset_expires = NULL 
            WHERE user_id = ?
        ");

        $update->bind_param("si", $hashedPassword, $user_id);
        $update->execute();

        $success = "Password successfully updated. You may now login.";
    }
}
?>

<h3>Reset Password</h3>

<?php foreach ($errors as $error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endforeach; ?>

<?php if ($success): ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php else: ?>

<form method="post">
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="New Password" required>
    </div>

    <div class="form-group">
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
    </div>

    <button class="btn btn-dark">Reset Password</button>
</form>

<?php endif; ?>
