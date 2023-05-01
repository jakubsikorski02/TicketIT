<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-login.css">
    <title>TicketIT</title>
</head>

<body>
<?php
include("includes/header.php");
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $user_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE login=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($user_password, $hashed_password)) {
            session_start();
            $_SESSION["logged"] = true;
            $_SESSION["userId"] = $row['id'];
            header("Location: index.php");
        } else {
            $errorMessage = "Nieprawidłowy login lub hasło.";
        }
    } else {
        $errorMessage = "Nieprawidłowy login lub hasło.";
    }

}
?>

    <div class="main-container">
        <div class="container-login">
            <form class="form" method="POST">
                <div class="input">
                    <p class="name">Login</p>
                    <input type="text" name="login" required>
                </div>
                <div class="input">
                    <p class="name">Password</p>
                    <input type="password" name="password" required>
                </div>
                <div class="log-btn">
                    <button class="submit-btn login-btn" value="Log in" type="submit">Log in</button>
                </div>
                <div class="info">
                <?php
                        if (isset($errorMessage)) {
                            echo "<p class='error'>$errorMessage</p>";
                            unset($errorMessage);
                        }
                ?>
            </div>
                <hr>
                <div class="register">
                    <a href="register.php"><button class="submit-btn register-btn" value="Sign up" type="button">Sign up</button></a>
                </div>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>2023 © Jakub Sikorski</p>
    </div>
</body>
</html>