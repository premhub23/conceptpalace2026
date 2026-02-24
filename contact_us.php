<?php
include 'includes/databaseconnect.php';
include 'includes/header.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔹 Sanitize inputs
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email     = trim($_POST['email']);
    $country   = trim($_POST['country']);
    $message   = trim($_POST['message']);

    $firstname = htmlspecialchars($firstname);
    $lastname  = htmlspecialchars($lastname);
    $email     = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message   = htmlspecialchars($message);

    // 🔹 Validation
    if (empty($firstname) || empty($lastname) || empty($email) || empty($message)) {
        $error = "All fields are required.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } 
    else {

        // 🔹 Check duplicate email
        $check = $conn->prepare("SELECT email FROM contact_us WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "This email has already submitted a message.";
        } 
        else {

            // 🔹 Insert into database
            $stmt = $conn->prepare(
                "INSERT INTO contact_us (firstname, lastname, email, country, message) 
                 VALUES (?, ?, ?, ?, ?)"
            );

            $stmt->bind_param("sssss", $firstname, $lastname, $email, $country, $message);

            if ($stmt->execute()) {

                // 🔹 Send Email
                $to = "your@email.com";  // CHANGE THIS
                $subject = "New Contact Message from ConceptPalace";
                $body = "Name: $firstname $lastname\n"
                      . "Email: $email\n"
                      . "Country: $country\n\n"
                      . "Message:\n$message";

                $headers = "From: $email";

                mail($to, $subject, $body, $headers);

                $success = "Message sent successfully!";
            } 
            else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>




<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>
</head>

<body>
	 <div>

		<p> Welcome to ConceptPalace.</p>
		
		<p> If you desire more information, leave us a message.</p>
		
	</div>           
		
		<div class="container mt-5">

<h2>Contact Us</h2>
<p>If you desire more information, leave us a message.</p>

<?php if($success): ?>
<div class="alert alert-success">
    <?php echo $success; ?>
</div>
<?php endif; ?>

<?php if($error): ?>
<div class="alert alert-danger">
    <?php echo $error; ?>
</div>
<?php endif; ?>

<form method="post">

<div class="form-group">
<label>First Name</label>
<input type="text" name="firstname" class="form-control" required>
</div>

<div class="form-group">
<label>Last Name</label>
<input type="text" name="lastname" class="form-control" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="form-group">
<label>Country</label>
<select name="country" class="form-control">
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Barbados">Barbados</option>
<option value="Dominica">Dominica</option>
<option value="Grenada">Grenada</option>
<option value="St. Kitts and Nevis">St. Kitts and Nevis</option>
<option value="St. Lucia">St. Lucia</option>
<option value="St. Vincent and the Grenadines">St. Vincent and the Grenadines</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
</select>
</div>

<div class="form-group">
<label>Message</label>
<textarea name="message" class="form-control" rows="5" required></textarea>
</div>

<button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>

<?php include 'includes/footer.php'; ?>
	
</body>
</html>