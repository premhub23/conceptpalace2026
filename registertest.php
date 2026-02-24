<?php
session_start();
require 'includes/databaseconnect.php';
require 'includes/header.php';

$errors = [];

if (isset($_POST['register'])) {

    // Sanitize + Trim
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    $lastname  = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    $username  = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email     = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password  = $_POST['password'];

    // Validation
    if (empty($firstname) || empty($username) || empty($email) || empty($password)) {
        $errors[] = "All required fields must be filled.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // Check if email or username already exists
    $check = $conn->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $errors[] = "Email or Username already exists.";
    }

    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (firstname, lastname, email, username, password, role, created_at) 
             VALUES (?, ?, ?, ?, ?, 'user', NOW())"
        );

        $stmt->bind_param("sssss", $firstname, $lastname, $email, $username, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $errors[] = "Something went wrong. Try again.";
        }
    }
}
?>

<h3>Register</h3>

<?php foreach ($errors as $error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endforeach; ?>

<form method="post">

  <div class="form-group">
    <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
  </div>

  <div class="form-group">
    <input type="text" name="lastname" class="form-control" placeholder="Last Name">
  </div>

  <div class="form-group">
    <input type="text" name="username" class="form-control" placeholder="Username" required>
  </div>

  <div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="Email" required>
  </div>

  <div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>

  <button name="register" class="btn btn-dark">Register</button>
</form>

<p>Already registered?
            <a href="logintest.php" style="text-decoration: none;">
                proceed to login
            </a>
        </p>

<?php require 'includes/footer.php'; ?>
