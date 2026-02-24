<?php
session_start();
require 'includes/databaseconnect.php';
require 'includes/header.php';

$success = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email.";
    }

    if (empty($errors)) {

        // Check if email exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

            $update = $conn->prepare("
                UPDATE users 
                SET reset_token = ?, reset_expires = ? 
                WHERE email = ?
            ");
            $update->bind_param("sss", $token, $expires, $email);
            $update->execute();

            // 🔴 Replace with real domain
            $resetLink = "http://yourdomain.com/reset.php?token=" . $token;

            // TODO: Send email properly using PHPMailer
            // mail($email, "Password Reset", "Click here: $resetLink");

            $success = "If the email exists, a reset link has been sent.";
        } else {
            // Do NOT reveal email existence
            $success = "If the email exists, a reset link has been sent.";
        }
    }
}
?>

<h3>Forgot Password</h3>

<?php foreach ($errors as $error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endforeach; ?>

<?php if ($success): ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
    </div>
    <button class="btn btn-dark">Send Reset Link</button>
</form>
