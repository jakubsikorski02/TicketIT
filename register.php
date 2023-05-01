<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-register.css">
    <title>TicketIT</title>
</head>

<body>
<?php
include("includes/header.php");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = 0;
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR login=?");
    $stmt->bind_param("ss", $email, $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $message = "User account with this email or login already exists.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters long.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, login, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $email, $login, $password_hash, $role);
        if ($stmt->execute()) {
            header("refresh:3;url=login.php");
            echo '<h2>Redirecting..</h2>';
            exit;
        } else {
            $message = "Error creating user account: " . $stmt->error;
        }
    }
}
?>

<div class="main-container">
    <div class="container-register">
        <form class="form" method="POST">
            <div class="input">
                <p class="name">Email</p>
                <input type="text" name="email" required>
            </div>
            <div class="input">
                <p class="name">Login</p>
                <input type="text" name="login" required>
            </div>
            <div class="input">
                <p class="name">Password</p>
                <input type="password" name="password" required>
            </div>
            <div class="register">
                <button class="submit-btn register-btn" type="submit" name="submit">Sign up</button>
            </div>
            <div class="info">
                <?php if (isset($message)): ?>
                    <p class='error' style="color: red; font-size: 12px;"><?php echo $message ?></p>
                <?php endif; ?>
            </div>
            <hr>
            <div class="already-have">
                <span class="login-btn" name="alreadyHave">Already have an account? <a href="login.php">Log in</a></span>
            </div>
        </form>
    </div>
</div>
<div class="footer">
    <p>2023 © Jakub Sikorski</p>
</div>
</body>

</html>