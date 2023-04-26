<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-login.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("header.php");
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

                $_SESSION["logged"] = true;
                $_SESSION["user_id"] = $row['id'];
                header("Location: index.php");


                exit();
            } else {
                echo "<div class='container-login'><p class='error'>Nieprawidłowe hasło.</p></div>";
            }
        } else {
            echo "<div class='container-login'><p class='error'>Nieprawidłowy login.</p></div>";
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
                <hr>
                <div class="register">
                    <a href="register.php"><button class="submit-btn register-btn" value="Sign up" type="button">Sign up</button></a>
                </div>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>
</body>