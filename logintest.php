<?php
session_start();
require 'includes/databaseconnect.php';
require 'includes/header.php';

$errors = [];

if (isset($_POST['login'])) {

    $email    = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {

        $stmt = $conn->prepare("SELECT user_id, firstname, username, password, role 
                                FROM users WHERE email = ? LIMIT 1");

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                // Secure session
                session_regenerate_id(true);

                $_SESSION['user_id']  = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['role']     = $user['role'];

                header("Location: index.php");
                exit;
            }
        }

        $errors[] = "Invalid email or password.";
    }
}
?>

<h3>Login</h3>

<?php foreach ($errors as $error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endforeach; ?>

<form method="post">

  <div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="Email" required>
  </div>

  <div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>

  <button name="login" class="btn btn-dark">Login</button>
</form>

<div class="container">
   
    <span class="password">Forgot <a href="forgot.php">password?</a></span>
  </div>

        
        <p>Not registered?
            <a href="registertest.php" style="text-decoration: none;">
                Create an account
            </a>
        </p>
    </div>
<?php require 'includes/footer.php'; ?>
